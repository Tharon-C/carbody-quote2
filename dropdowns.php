
<section ng-app="app">
<div class="container pad-tb-50px" ng-controller="page">
<div class="col-md-4">

  <div ng-controller="iq_lookup"
          ng-init="loadData()">
    <h1 class="h1">Instant Quote</h1>
    <hr>

    <div ng-controller="iq_make"
             id="Make"
             ng-init="loadData()">
      <form id="MakeForm">
        <div class="form-group">
          <label>Make</label><br>
          <div cg-busy="{promise:spinner,message:'Loading Selections'}"></div>
          <select id="iq-make" class="form-control" ng-model="request.make" ng-change="loadSectionData('Model')">
            <option ng-repeat="choice in result.makes" ng-value="choice.niceName">
              {{ choice.name }}
            </option>
          </select>
        </div>
      </form>
    </div>

    <div ng-controller="iq_model"
            id="Model">  
      <form id="ModelForm">
        <div class="form-group">
          <label>Model</label><br>
          <select  id="iq-model" class="form-control" ng-model="request.model" ng-change="loadSectionData('Year')">
            <option ng-repeat="choice in result.models" ng-value="choice.niceName">
              {{ choice.name }}
            </option>
          </select>
        </div>
      </form>
    </div>

    <div ng-controller="iq_year"
            id="Year">  
      <form id="YearForm">
        <div class="form-group">
            <label>Year</label><br>
            <select id="iq-year" class="form-control" ng-model="request.year" ng-change="loadSectionData('TMVInputs')">
              <option ng-repeat="choice in result.years" ng-value="choice.year">
                {{ choice.year }}
              </option>
            </select>
        </div>
      </form>
    </div>

    <div ng-controller="iq_style"
            id="TMVInputs">  
      <form id="StyleForm">
        <div class="form-group">
            <label>Style</label><br>
            <select id="iq-body" class="form-control" 
                    ng-change="selctAction" 
                    ng-model="request.style" >
              <option ng-model="oppt" ng-repeat="choice in result.styles | unique: 'submodel.body'" 
              ng-value="choice.submodel.body">
                {{ choice.submodel.body }}
              </option>
            </select>
        </div>
      </form>
    </div>

    <div ng-controller="iq_submit" id="TMVsubmit" >
          <form id="SubmitForm">
            <button id="get-quote" ng-click="show_it(request.style)" class="btn btn-success form-control">Get Quote</button>
          </form>
    </div>    

</div>
</div>
</section>