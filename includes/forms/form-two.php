

<div class="forms-container p-4 p-sm-5 bg-white">
  <form id="form-2" novalidate="" autocomplete="off">
    <fieldset>
      <legend>Tell us a bit about yourself</legend>
      <div class="form-wrapper">
        <div class="form-group">
          <div>
            <label for="inputEmail">Email Address</label>
            <input
                  disabled
                  type="email"
                  class="form-control is-valid"
                  id="inputEmail2"
                  required=""
                  name="email"
                  pattern="^([a-zA-Z0-9_\-]+[\+\.])*([a-zA-Z0-9_\-])+@[a-zA-Z0-9]+([_\-\.][a-zA-Z0-9]+)*\.[a-zA-Z0-9]+([\-.][a-zA-Z0-9]+)*$"
                  maxlength="100"

                />
          </div>
        </div>
        <div class="form-group">
          <div>
            <!-- pattern="^[a-z A-Z0-9]+$" -->
            <label for="inputFN">First name</label>
            <input
                  type="text"
                  class="form-control"
                  id="inputFN"
                  required=""
                  name="first_name"
                  minLength="2"
                  maxlength="26"
                  placeholder="Please enter your first name"
                />
          </div>
        </div>
        <div class="form-group">
          <div>
            <label for="inputLN">Last Name</label>
            <input
                  type="test"
                  class="form-control"
                  id="inputLN"
                  required=""
                  name="last_name"
                  minLength="2"
                  maxlength="26"
                  placeholder="Please enter your last name"
                />
          </div>
        </div>
        <div class="form-group">
          <div>
            <label for="inputPN">Phone number (optional)</label>
            <input
                type="tel"
                class="form-control"
                id="phoneNumber"
                pattern="^[0-9]+$"
                minlength="6"
                maxlength="15"
                name="phone_number"
                inputMode="numeric"
              />
            <div id="phoneFeedback" class="invalid-feedback">Please enter a valid phone number.</div>
          </div>
        </div>
      </div>
    </fieldset>
      <input type="submit" class="d-none">
  </form>
  <form id="form-3" novalidate="" autocomplete="off" class="d-none">
    <fieldset>
      <legend>Now tell us a little about your business</legend>
      <div class="form-wrapper">
        <div class="form-group">
          <div>
            <label for="CompanyName">Company name</label>
            <input
            type="text"
            class="form-control"
            id="CompanyName"
            required=""
            name="company_name"/>
          </div>
        </div>
        <div class="form-group">
          <div>
            <label for="inputA1">Address 1</label>
            <input
                  type="text"
                  class="form-control"
                  id="inputA1"
                  required=""
                  name="address1"/>
          </div>
        </div>
        <div class="form-group">
          <div>
            <label for="inputA2">Address 2</label>
            <input
              type="text"
              class="form-control"
              id="inputA2"
              name="address2"/>
          </div>
        </div>
        <div class="form-group">
          <div>
            <label for="city">City</label>
            <input
                type="text"
                class="form-control"
                id="city"
                required=""
                name="city"/>
            </div>
        </div>
        <div class="form-group">
           <div>
              <label for="country">Country</label>
              <select class="form-select form-control" id="country" name="country"  required>
               <?php GetDDLVals('countries'); ?>
             </select>
              <!-- <select class="form-select form-control" id="country" name="country"  required>
                <option value=""> - Please Select - </option>
                <option value="US">United State</option>
                <option value="CA">Canada</option>
              </select> -->
            </div>
        </div>
        <div id="province-row" class="form-group d-none">
          <div>
            <label for="Province">Province</label>
            <select class="form-select form-control" id="Province" name="province" required>
              <?php GetDDLVals('province'); ?>
            </select>
          </div>
        </div>
        <div id="state-row" class="form-group d-none">
          <div class="autocomplete">
            <label for="state">State</label>
            <input
                  type="text"
                  class="form-control"
                  id="state"
                  required=""
                  name="state"/>
          </div>
        </div>
        <div class="form-group">
          <div>
            <label id="zipLabel" for="zip">Zipcode</label>
            <input
                  type="text"
                  class="form-control"
                  required=""
                  id="zip"
                  name="zip"
                  pattern="^[0-9a-zA-Z ]+$"
                  minlength="3"
                  maxlength="10"
                />
          </div>
        </div>
        <!-- <div class="form-group">
          <div>
            <label for="vat_number">EIN/VAT number</label>
            <input
                  type="text"
                  class="form-control"
                  id="vat_number"
                  required=""
                  name="vat_number"
                  placeholder="Please do not include dashes or spaces"
                />
          </div>
        </div> -->
        <!-- <div class="form-group">
          <label>Does your company import or export? (optional)</label>
          <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center my-3 form-radio-group">
            <div class="form-check mb-2 m-sm-0">
              <input type="radio" class="form-check-input" name="import_export" id="import_export_0" value="Neither" autocomplete="off">
              <label class="form-check-label" for="import_export_0">Neither</label>
            </div>
            <div class="form-check mb-2 m-sm-0">
                <input type="radio" class="form-check-input" name="import_export" id="import_export_1" value="Import" autocomplete="off">
                <label class="form-check-label" for="import_export_1-answer-yes">Import</label>
            </div>
            <div class="form-check mb-2 m-sm-0">
                <input type="radio" class="form-check-input" name="import_export" id="import_export_2" value="Export" autocomplete="off">
                <label class="form-check-label" for="import_export_2">Export</label>
            </div>
            <div class="form-check mb-2 m-sm-0">
                <input type="radio" class="form-check-input" name="import_export" id="import_export_3" value="ImportAndExport" autocomplete="off">
                <label class="form-check-label" for="import_export_2">Import and Export</label>
            </div>
          </div>
        </div> -->

      </div>
    </fieldset>
      <input type="submit" class="d-none">
  </form>
  <div class="d-flex">
    <div>
      <button
        id="next-step-btn"
        type="button"
        class="btn btn-primary rounded-pill"
        name="nextStep">
        Next <i class="bi bi-arrow-right"></i>
      </button>
    </div>
  </div>
</div>
