

<div class="forms-container mb-5">
  <form id="form-1" novalidate="" autocomplete="off">
    <fieldset>
      <div class="form-wrapper">
        <div class="form-group">
          <div>
            <label for="inputEmail">Email Address</label>
            <input
                  type="email"
                  class="form-control"
                  id="inputEmail"
                  required=""
                  name="email"
                  pattern="^([a-zA-Z0-9_\-]+[\+\.])*([a-zA-Z0-9_\-])+@[a-zA-Z0-9]+([_\-\.][a-zA-Z0-9]+)*\.[a-zA-Z0-9]+([\-.][a-zA-Z0-9]+)*$"
                  maxlength="100"
                />
          </div>
        </div>
      </div>
    </fieldset>
    <div class="d-flex">
      <div>
        <button
          type="submit"
          class="btn btn-primary rounded-pill"
          name="nextStep">
          Next <i class="bi bi-arrow-right"></i>
        </button>
      </div>
    </div>
  </form>
</div>
