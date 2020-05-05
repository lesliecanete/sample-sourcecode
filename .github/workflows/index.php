<!DOCTYPE html>
<html>
  <head>
    <title>CRUD with PHP and Angular JS</title>
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">-->
    <!--<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>-->
   
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="jquery.min.js"></script>
    <script src="angular.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  <body>
    <div class="container" ng-app="customer_app" ng-controller="customer_controller" ng-init="fetchData()">
      <br />
      <h3 align="center">AngularJS CRUD using PHP Mysql</h3>
      <br />
      <div class="alert alert-success alert-dismissible" ng-show="success" >
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{successMessage}}
      </div>
      <div class="form-group">
        <div class="input-group">
          <div align="right">
            <button type="button" name="add_button" ng-click="addData()" class="btn btn-success">Add</button>
          </div>
        </div>
      </div>
      
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon">Search</span>
          <input type="text" name="search_query" ng-model="search_query" ng-keyup="fetchData()" placeholder="Search by Customer Details" class="form-control" />
        </div>
      </div>
      <br />
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Address</th>
            <th>City</th>
            <th>Postal Code</th>
            <th>Country</th>
            <th>Tel Number</th>
            <th>Action</th>
            <td></td>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="data in searchData">
            <td>{{ data.Firstname }}</td>
            <td>{{ data.Lastname}}</td>
            <td>{{ data.Gender }}</td>
            <td>{{ data.Address }}</td>
            <td>{{ data.City }}</td>
            <td>{{ data.PostalCode }}</td>
            <td>{{ data.Country }}</td>
            <td>{{ data.TelNumber }}</td>
            <td><button type="button" ng-click="update(data.ID)" class="btn btn-warning btn-xs">Edit</button></td>
            <td><button type="button" ng-click="delete(data.ID)" class="btn btn-danger btn-xs">Delete</button></td>

          </tr>
        </tbody>
      </table>
      <div class="modal fade" tabindex="-1" role="dialog" id="crudmodal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form method="post" ng-submit="insert()" name="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{modalTitle}}</h4>
              </div>
              <div class="modal-body">
                <div class="alert alert-danger alert-dismissible" ng-show="error" >
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  {{errorMessage}}
                </div>
                <div class="form-group">
                  <label>First Name</label>
                  <input type="text" name="firstname" ng-model="formData.Firstname" class="form-control"/>
                </div>
                <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" name="lastname" ng-model="formData.Lastname" class="form-control"/>
                </div>
                <div class="form-group">
                  <label>Gender</label>
                  <select name="gender" ng-model="gender" class="form-control">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <input type="hidden" name="hidden_id" value="{{hidden_id}}" />
                <button type="submit" name="submit" id="submit" class="btn btn-info">{{btnText}}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </body>
</html>
<script src="app.js"></script>