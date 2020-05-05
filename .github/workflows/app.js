 var app = angular.module('customer_app', []);
  app.controller('customer_controller', function($scope, $http){
    $scope.btnText = "Save";
    $scope.icon = "glyphicon glyphicon-floppy-disk";
    $scope.btnClass = "btn btn-primary";
    $scope.success = false;
    $scope.error = false;
    $scope.openModal = function(){
      var modal_popup = angular.element('#crudmodal');
      modal_popup.modal('show');
     };
  
    $scope.closeModal = function(){
      var modal_popup = angular.element('#crudmodal');
      modal_popup.modal('hide');
     };
   $scope.fetchData = function(){
    $http({
     method:"POST",
     url:"fetch.php",
     data:{search_query:$scope.search_query}
    }).success(function(data){
     $scope.searchData = data;
    });
   };
    $scope.addData = function(){
      $scope.modalTitle = 'Add Customer';
      $scope.btnText = 'Save';
      $scope.btnAction="Save";
      $scope.formData = {};
      $scope.form.$setPristine()

      $scope.openModal();
    };
  
    
    $scope.insert = function() {
      
        if ($scope.formData.Firstname == null) {
            alert("Please input Firstname");
        } 
        else if ($scope.formData.Lastname == null) {
            alert("Please input Lastname");
        }  
        else {
            $http.post(
                "action.php", {
                    'firstname': $scope.formData.Firstname,
                    'lastname': $scope.formData.Lastname,
                    'id': $scope.formData.Id,
                    'btnAction': $scope.btnAction
                }
            ).success(function(data) {
                $scope.firstname = null
                $scope.lastname = null;
                $scope.btnName = "Save";
                $scope.icon = "glyphicon glyphicon-floppy-disk";
                $scope.btnClass = "btn btn-primary";
                $scope.fetchData();
                $scope.closeModal();
                $scope.selectedRecord={};
                $scope.successMessage=data;
                $scope.success=true;
            });
        }
    }

    $scope.update = function(id) {
        $scope.id = id;
        //fetch data with current id
        $scope.fetchSingleData(id);
        $scope.icon = "glyphicon glyphicon-check";
        $scope.btnClass = "btn btn-success";
        $scope.btnText = "Update";
        $scope.btnAction="Update";
        $scope.modalTitle = 'Edit Customer';
        $scope.openModal();

    }
    $scope.fetchSingleData = function (id){
      $scope.id=id;
      $http({
       method:"POST",
       url:"fetch.php",
       data:{id : $scope.id}
      }).success(function(data){
        $scope.formData=data;
        $scope.formData.Id=id;
      });
    }
    $scope.delete= function(id) {
        if (confirm("Are you sure you want to delete the customer?")) {
            $http.post("delete.php", {
                    'Id': id
                })
                .success(function(data) {
                    $scope.successMessage=data;
                    $scope.success=true;
                    $scope.fetchData();
                });
        } else {
            return false;
        }
    }
    $scope.enter = function(keyEvent) {
        if (keyEvent.which === 13){
            insert();
        }
    }
  });