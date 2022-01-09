(function ($) {
  let validator = {};
  let iti = {};
  let _currentStep = {};
  let _nextStep = {};
  const selector = "input, textarea, select";
  let _userId = "";
  const _marketingUTMS = [
    "utm_source",
    "utm_medium",
    "utm_content",
    "utm_campaign",
  ];
  let _utms = {};

  //set cookie
  function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }
  // get cookie value by key
  function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(";");
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == " ") {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

  $(document).ready(function () {
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());

    _marketingUTMS.forEach((item, i) => {
      //if have utms in cookie
      const cookieVal = getCookie(item);
      if (cookieVal && cookieVal != null) {
        _utms[item] = cookieVal;
      }

      //if have utms in URL
      const keys = Object.keys(params);
      const relevantKey = keys.find((c) => item == c);
      if (relevantKey) {
        setCookie(item, params[relevantKey], 30);
        _utms[relevantKey] = params[relevantKey];
      }
    });

    $(window).keydown(function (event) {
      if (event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
    _currentStep = $("#form-1");

    validator = $("form").jbvalidator({
      language:
        "/wp-content/plugins/ctm-reg/dist/js/vendors/jbvalidator/lang/en.json",
      errorMessage: true,
      successClass: true,
      html5BrowserDefault: false,
      validFeedBackClass: "valid-feedback",
      invalidFeedBackClass: "invalid-feedback",
      validClass: "is-valid",
      invalidClass: "is-invalid",
    });

    // Custom validate method
    validator.validator.custom = function (el, event) {
      if ($(el).is("[name=email]") && el.checkValidity()) {
        const domain = el.value.split("@")[1];
        if (_blackListEmails.some((c) => c == domain)) {
          return "Invalid email address";
        }
      }

      if (
        el.value != "" &&
        $(el).is("[name=phone_number]") &&
        el.checkValidity()
      ) {
        if (iti.isValidNumber() != true || iti.getValidationError() !== 0) {
          return "Please enter a valid phone number.";
        }
      }

      return "";
    };

    iti = intlTelInput(document.querySelector("#phoneNumber"), {
      initialCountry: "auto",
      geoIpLookup: function (callback) {
        $.get("https://ipinfo.io", function () {}, "jsonp").always(function (
          resp
        ) {
          var countryCode = resp && resp.country ? resp.country : "";
          callback(countryCode);
        });
      },
      utilsScript:
        "/wp-content/plugins/ctm-reg/dist/js/vendors/int-tel-input/js/utils.js?1585994360633",
    });

    // for step 1 only
    _currentStep.submit((e) => {
      e.preventDefault();
      if (!validateForm(e)) {
        return;
      }

      _nextStep = getNextStep(_currentStep);

      _currentStep.addClass("d-none");
      _nextStep.removeClass("d-none");
      _currentStep = _nextStep;
    });

    // for rest
    $("#next-step-btn").click((e) => {
      _currentStep.submit((event) => {
        event.preventDefault();
      });
      if (!validateForm(e)) {
        return;
      }

      _nextStep = getNextStep(_currentStep);

      _currentStep.addClass("d-none");

      if (_currentStep.is($("#form-3"))) {
        return;
      }

      _nextStep.removeClass("d-none");
      _currentStep = _nextStep;
    });
  });

  let validateForm = (event) => {
    let status = 0;

    _currentStep.find(selector).each((i, el) => {
      if (el.name == "province" && $("#country").val() == "US") {
        return;
      }

      if (el.name == "state" && $("#country").val() == "CA") {
        return;
      }
      if (
        (el.name == "state" || el.name == "province") &&
        $("#country").val() != "CA" &&
        $("#country").val() != "US"
      ) {
        return;
      }

      if (el.checkValidity() === false) {
        status++;
      }
    });

    if (status) {
      if (!_currentStep.is($("#form-1"))) {
        _currentStep.find(":submit").click();
      }

      return false;
    }

    return true;
  };

  const getNextStep = (current_step) => {
    let nextStep = {};
    let stepNum = 0;
    const email = $("#form-1 input[name='email']").val();

    if (current_step.is($("#form-1"))) {
      $("#first-row").removeClass("show");
      $(".step-1-title").addClass("show");
      $(".custom-progress-bar ul li:first-child").addClass("active-step");
      $("#form-2 input[name='email']").val(email);
      $("#second-row").addClass("show");
      $("#steps-progress-bar").addClass("show");

      $("#form-2 input[name='first_name']").focus();
      stepNum = "step_1";
      nextStep = $("#form-2");
    } else if (current_step.is($("#form-2"))) {
      nextStep = $("#form-3");
      $(".step-2-title").addClass("show");
      $(".step-1-title").removeClass("show");
      $(".custom-progress-bar ul li:first-child").removeClass("active-step");
      $(".custom-progress-bar ul li:first-child").addClass("step-done");
      $(".custom-progress-bar ul li:nth-child(2)").addClass("active-step");
      $("#next-step-btn").text("Sign up");
      $("#form-3 input[name='company_name']").focus();
      stepNum = "step_2";
      const txt = $(".thank-you-title")
        .html()
        .replace("[Firstname]", $("#inputFN").val());
      $(".thank-you-title").html(txt);
    } else {
      $("#second-row").removeClass("show");
      $(".thank-you-title").addClass("show");
      $(".step-2-title").removeClass("show");
      $("#ty-page").addClass("show");
      $(".custom-progress-bar ul li:nth-child(2)").removeClass("active-step");
      $(".custom-progress-bar ul li:nth-child(2)").addClass("step-done");
      $(".custom-progress-bar ul li:nth-child(3)").addClass("active-step");

      stepNum = "submit";
      _nextStep = null;
    }

    if (stepNum == "step_1") {
      createLead(email);
    } else {
      updateLeadDetails(stepNum);
    }

    return nextStep;
  };

  $(document).on("change", "#country", function (e) {
    let valueSelected = this.value;
    $("#zipLabel").text("Zipcode");

    if (this.value == "United States") {
      autocomplete(document.getElementById("state"), _statesData);
      if (!$("#province-row").hasClass("d-none")) {
        $("#province-row").addClass("d-none");
      }
      $("#state-row").removeClass("d-none");
    } else if (this.value == "Canada") {
      $("#zipLabel").text("Postal code");
      $("#state").val("");
      $("#state").removeClass("is-valid");
      if (!$("#state-row").hasClass("d-none")) {
        $("#state-row").addClass("d-none");
      }
      $("#province-row").removeClass("d-none");
    } else {
      $("#state").val("");
      $("#state").removeClass("is-valid");
      autocomplete(document.getElementById("state"), []);
      if (!$("#province-row").hasClass("d-none")) {
        $("#province-row").addClass("d-none");
      }
      if ($("#state-row").hasClass("d-none")) {
        $("#state-row").removeClass("d-none");
      }
    }
  });

  const createLead = (email) => {
    let formData = new FormData();
    formData.append("email", email);
    Object.keys(_utms).forEach((key) => {
      formData.append(key, _utms[key]);
    });

    fetch(ctm_reg.ajaxurl + "?action=createLead", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        _userId = data.id;
      })
      .catch((err) => {
        console.error(err);
      });
  };

  const updateLeadDetails = (stepNum) => {
    let request = {};
    let formData = new FormData();
    $("#form-2")
      .serializeArray()
      .forEach((item, i) => {
        formData.append(item.name, item.value);
      });
    $("#form-3")
      .serializeArray()
      .forEach((item, i) => {
        formData.append(item.name, item.value);
      });

    formData.append("uid", _userId);
    formData.append("step", stepNum);

    fetch(ctm_reg.ajaxurl + "?action=updateLeadDetails", {
      method: "POST",
      credentials: "same-origin",
      body: formData,
    })
      .then((res) => res.json())
      .then((response) => {
        console.log(response);
        if (response && response.StatusCode == 403) {
          $("#server-alert").addClass("show");
        }
      })
      .catch((err) => console.log(err));
  };

  function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function (e) {
      var a,
        b,
        i,
        val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) {
        return false;
      }
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        var pos = arr[i].toUpperCase().indexOf(val.toUpperCase());
        /*check if the item starts with the same letters as the text field value:*/
        if (pos > -1) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = arr[i].substr(0, pos);
          b.innerHTML +=
            "<strong>" + arr[i].substr(pos, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(pos + val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function (e) {
            /*insert the value for the autocomplete text field:*/
            inp.value = this.getElementsByTagName("input")[0].value;
            /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
            closeAllLists();
          });
          a.appendChild(b);
        }
      }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function (e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
          increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) {
        //up
        /*If the arrow UP key is pressed,
          decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
    });
    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = x.length - 1;
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }
    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
      closeAllLists(e.target);
    });
  }
})(jQuery);
