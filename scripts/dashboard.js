app.controller('dashboardCtrl',function($scope, $rootScope, $http){
	
	// $rootScope.pageData.header = "Dashboard";
	// $rootScope.pageData.subtitle = "Overzicht";
	// $rootScope.pageData.breadcrumps = ["Dasboard"];

	$scope.alleProducten = function(){
		$http.post("server/read.php",{'subject': "get_products"})
		.success(function (response) {
			console.log(response)
			$scope.products = response.records;
			// $scope.customers = response.records;
			// console.log($scope.customers);
		});
	}
	$scope.alleProducten();

    $scope.bekijkProduct = function(id){
    	console.log("bekijkproduct");
    	$http.post("server/read.php",{'subject': "get_products", "id": id})
		.success(function (response) {
			console.log(response.records)
			$scope.products.details = response.records[0];
			// $scope.customers = response.records;
			// console.log($scope.customers);
		});
    }

    $scope.voorraadPlus = function(index) {
    	console.log($scope.products.details);
	
		$scope.products.details.voorraad = parseFloat($scope.products.details.voorraad) + 1;
    }

    $scope.voorraadMin = function(index) {
    	console.log($scope.products.details);
	
		$scope.products.details.voorraad = parseFloat($scope.products.details.voorraad) - 1;
    }

    $scope.productOpslaan = function(id){
    	console.log(id);

    	$http.post("server/update.php",{'subject': "update_product", "args": $scope.products.details})
		.success(function (response) {
			console.log(response);
			// $scope.customers = response.records;
			// console.log($scope.customers);
			$scope.alleProducten();
		});
    }
    $scope.productToevoegen = {};
    $scope.productToevoegen.plaats = "";
    $scope.productToevoegen.artikelcode = "";
    $scope.productToevoegen.artikelnummer = "";
    $scope.productToevoegen.artikel_naam = "";
    $scope.productToevoegen.omschrijving = "";
    $scope.productToevoegen.voorraad = "";
    $scope.productToevoegen.inkoopprijs_ex_btw = "";
    $scope.productToevoegen.verkoopprijs_ex_btw = "";
    $scope.productToevoegen.btw = "";
    $scope.productToevoegen.eenheid = "";
    $scope.productToevoegen.plaats = "";
    $scope.productToevoegen.modalOpen = false;

    $scope.showfieldslimit = 20;

    $scope.showlimit = [20, 100, 200, 500, 1000, 10000];

    console.log($scope.productToevoegen);


    $scope.productToevoegenfnc = function(){
    	console.log($scope.productToevoegen);
    	$scope.productToevoegen.modalOpen = true;

    	$http.post("server/insert.php",{'subject': "add_product", "args": $scope.productToevoegen})
		.success(function (response) {
			console.log(response);
			$scope.alleProducten();
			$scope.productToevoegen.modalOpen = false;
			$rootScope.succesModalBox(true, "Product is succesvol toegevoegd");
			// $scope.customers = response.records;
			// console.log($scope.customers);
		});
    }

})