var controlador_compras = new Vue({
	el: '#controlador_compra',
	data: {
	   cargando_compra: true,
	   compra_nueva: {
		  nombre: '',
		  descripcion: '',
		  precio:'',
		  imagen : null,
		  categoria:''

	   },
		compras: []

	},
	// filter('capitalize', function (value) {
	// 	if (!value) return ''
	// 	value = value.toString()
	// 	return value.charAt(0).toUpperCase() + value.slice(1)
	//   },
	  
	methods: {
		getImage(event){
		
			this.image = event.target.files[0];
		},
		updateAvatar(){

			var data = new  FormData();
		
			data.append('avatar', this.image);
			
			data.append('_method', 'PUT');

			axios.post('/dashboard/avatar',data)
			.then(response => {

			})
		},
	
	   recuperarCompra: function(){
		  this.cargando_compra = true;
		  this.$http.get('recuperar_compra').then(function(respuesta){
			 this.compras = respuesta.body;
			 this.cargando_compra = false;
		  }, function(){
			 alert('No se han podido cargar');
			 this.cargando_compra = false;
		  }); 
	   },
	   compraNueva: function(){
		  this.$http.post('', this.compra_nueva).then(function(){
			 this.compra_nueva.nombre = '';
			 this.compra_nueva.descripcion = '';
			 this.compra_nueva.precio = '';
			 this.compra_nueva.imagen = '';
			 this.compra_nueva.categoria.nombre_categoria = '';
			 this.recuperarCompra();
		  }, function(){
			 alert('No se ha podido crear la compra.');
		  });
	   },
	   modificarCompra: function(p_compra){
		  this.$http.post('modificar_compra', p_compra).then(function(){
			 this.recuperarCompra();
		  }, function(){
			 alert('No se ha podido modificar la compra.');
		  });
	   },
	   eliminarCompra: function(p_compra){
		  this.$http.post('eliminar_compra', p_compra).then(function(){
			 this.recuperarTareas();
		  }, function(){
			 alert('No se ha podido eliminar la compra.');
		  });
	   },
	   
	},
	created: function(){
	   this.recuperarCompra();
	}
 });
