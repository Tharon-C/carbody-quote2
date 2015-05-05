
<section class="quote-chooser" ng-app="app">
<div ng-controller="page">

  <div ng-controller="iq_lookup"
          ng-init="loadData()">
    <h1 class="h1">Instant Quote</h1>
    <p>Please choose a selection from each of the fields below, starting with your vehicle's make.</p>
    <hr>

    <div ng-controller="iq_make"
             id="Make"
             ng-init="loadData()">
      <form id="MakeForm">
        <div class="form-group">
          <label>Make *</label><br>
          <div cg-busy="{promise:spinner,message:'Loading Selections',minDuration:600}"></div>
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
          <label>Model *</label><br>
          <div cg-busy="{promise:spinner,message:'Loading Selections',delay:200,minDuration:600}"></div>
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
            <label>Year *</label><br>
            <div cg-busy="{promise:spinner,message:'Loading Selections',delay:200,minDuration:600}"></div>
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
            <label>Style *</label><br>
            <div cg-busy="{promise:spinner,message:'Loading Selections',delay:200,minDuration:600}"></div>
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
    <div class="clearfix" > 
    <span id="iq-not-found" class="btn p-r marg-t-10px">Can't find your vehicle?</span>
    </div>
</div>
<form id="iq-body-select" class="hide">
        <label>Choose a body style *</label><br>
        <div class="form-group">
            <select id="iq-body-alt" class="form-control"  >
            <option>-- Select One --</option>
            <option>SUV</option>
            <option>Sedan</option>
            <option>Hatchback</option>
            <option>Convertible</option>
            <option>Wagon</option>
            <option>Crew Cab</option>
            <option>Extended Cab</option>
            <option>Regular Cab</option>
            <option>Supercab</option>
            <option>Double Cab</option>
            <option>Van</option>
            <option>Minivan</option>
            </select>
        </div>
      </form>
</div>
</section>