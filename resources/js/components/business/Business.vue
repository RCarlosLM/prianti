<template>
	<div>

        <div class="row">

            <div class="col-md-4 mt-3">

        		<div class="card border-info">
					<div class="card-header bg-light">
						<h4>
					  		Ejercicio 1
						</h4>
					</div>
          			<div class="card-body">
            			<div class="row">
                            <div class="col-md-12 mt-1">
								<label for="cadena" class="font-weight-bold">
									Cadena de Texto
								</label>
								<input
								    v-model="cadena"
								    placeholder="The_One_Function"
								    class="form-control"
								    type="text"
								    >
						  		</input>
							</div>
                            <div class="col-md-12 mt-2">
                                <button type="button" class="btn btn-success" @click="ejercicio_1()">
                                    ejecutar
                                </button>
                                <span>
                                    {{cadena}}
                                </span>
                            </div>
      					</div>
    				</div>
				</div>

			</div>

            <div class="col-md-4 mt-3">

        		<div class="card border-info">
					<div class="card-header bg-light">
						<h4>
					  		Ejercicio 2
						</h4>
					</div>
          			<div class="card-body">
            			<div class="row">

      					</div>
    				</div>
				</div>

			</div>

            <div class="col-md-4 mt-3">

        		<div class="card border-info">
					<div class="card-header bg-light">
						<h4>
					  		Ejercicio 3
						</h4>
					</div>
          			<div class="card-body">
            			<div class="row">
                            
      					</div>
    				</div>
				</div>

			</div>

        </div>

		<div class="row mt-3">
		
			<div class="col-md-4 mt-4">

        		<div class="card border-info">
					<div class="card-header bg-light">
						<h4 v-if="!isEditing">
					  		Negocios
						</h4>
                        <h4 v-if="isEditing">
					  		Editar Negocio
						</h4>
					</div>
          			<div class="card-body">
            			<div class="row">

							<div class="col-md-12 mt-1">
								<label for="business_name" class="font-weight-bold">
									Razon Social
								  	<small v-if="data_errors.business_name" class="form-text error-input p-1 alert-danger fade show">
								    	{{ data_errors.business_name[0] }}
								  	</small>
								</label>
								<input
								    v-model="negocios.business_name"
								    placeholder="Razon Social"
								    class="form-control"
								    type="text"
								    >
						  		</input>
							</div>

                            <div class="col-md-12 mt-1">
								<label for="address" class="font-weight-bold">
									Dirección
								  	<small v-if="data_errors.address" class="form-text error-input p-1 alert-danger fade show">
								    	{{ data_errors.address[0] }}
								  	</small>
								</label>
								<input
								    v-model="negocios.address"
								    placeholder="Dirección"
								    class="form-control"
								    type="text"
								    >
						  		</input>
							</div>

                            <div v-if="!not_logo" class="col-md-12 mt-1">
								<label class="font-weight-bold">
                                    Logo
                                    <small v-if="data_errors.file != undefined" class="form-text error-input p-1 alert-danger fade show">
                                        {{ data_errors.file[0] }}
                                    </small>
                                </label>
                                <input 
                                    id="file"
                                    class="border p-file form-control"
                                    type="file"
                                    ref="file"
                                    v-on:change="handleFileUpload()">
                                </input>
							</div>

                            <div class="col-md-12 mt-1">
								<label for="short_name" class="font-weight-bold">
									Nombre
								  	<small v-if="data_errors.short_name" class="form-text error-input p-1 alert-danger fade show">
								    	{{ data_errors.short_name[0] }}
								  	</small>
								</label>
								<input
								    v-model="negocios.short_name"
								    placeholder="Nombre"
								    class="form-control"
								    type="text"
								    >
						  		</input>
							</div>

							<div class="col-md-12 mt-3">
				                <button type="button" class="btn btn-primary btn-block" @click="addBusiness" v-if="!isEditing">
				                  Agregar
				                </button>
                                <button class="btn btn-secondary" type="button" @click="cancelarEdit()"v-if="isEditing">
			                        Cancelar
			                    </button>
				                <button class="btn btn-primary pull-right" type="button" @click="updateBusiness()" v-if="isEditing">
			                        Actualizar
			                    </button>
				            </div>

      					</div>
    				</div>
				</div>

			</div>

			<div class="col md-8 mt-4">
				<div class="card border-info">
					<div class="card-header bg-light">
						<h4>
					  		Panel de Negocios
						</h4>
					</div>
					<div class="card-body">
			
						<div class="row mt-1">
							<div class="col-md-12">
								<vuetable ref="vuetable"
									:api-url="'business/show'"
									track-by="id"
									:fields="fields"
									:css="css.table"
									:show-sort-icons="true"
									:per-page="5"
									pagination-path="meta"
									:append-params="moreParams"
									@vuetable:pagination-data="onPaginationData">
									
									<div slot="logo-slot" slot-scope="props">
                                        <img :src="'/storage/'+props.rowData.file" alt="" class="img img-fluid zoom rounded style-img">
                                    </div>
                                    
                                    <div slot="opciones-slot" slot-scope="props">
				                        <a class="inline-block" @click="confirmarEliminar(props.rowData)" data-toggle="tooltip" data-placement="top" title="Eliminar">
				                            <i class="fa fa-trash text-danger fa-2x">
				                            </i>
				                        </a>
				                        <a class="text-info inline-block" @click="editBusiness(props.rowData)" data-toggle="tooltip" data-placement="top" title="Editar">
				                            <i class="fa fa-pen text-info fa-2x">
      										</i>
				                        </a>
				                    </div>

	              				</vuetable>
	              				<div style="margin-top:10px">
						            <div style="float: right;">
						                <vuetable-pagination ref="pagination"
											:css="css.pagination"
											class="pull-right"
											@vuetable-pagination:change-page="onChangePage"
						                	>
						                </vuetable-pagination>
						            </div>
						        </div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

	import Vuetable from "vuetable-2";
	import VuetablePagination from "../utils/VuetablePaginationBootstrap4.vue";
	import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
	import CssConfig from "../utils/TableStyles";
	import VueEvents from 'vue-events'
	Vue.use(VueEvents)

	export default {
		props: [''],
		components: {
			Vuetable,
			VuetablePagination,
			VuetablePaginationInfo,
		},
		data() {
			return {
				css: CssConfig,
				fields: [
					{
						name: "business_name",
						title: 'Razon Social',
						titleClass: 'center',
						sortField: "business_name",
					},
					{
						name: "address",
						title: 'Dirección',
						titleClass: 'center',
						sortField: "address",
					},
					{
						name: "logo-slot",
						title: 'Logo',
						titleClass: 'center',
					},
                    {
						name: "short_name",
						title: 'Nombre Corto',
						titleClass: 'center',
						sortField: "short_name",
					},
                    {
						name: "opciones-slot",
						title: 'Opciones',
						titleClass: 'center'
					}
				],
				moreParams: {},
                isEditing: false,
                not_logo: false,
                file: '',
				negocios: {
				    business_name: '',
				    address: '',
                    short_name: ''
				},
				data_errors: [],

                // variables ejercicios
                cadena: '',
                array_three: ''
					
			}
		},
		created(){
		},
		methods: {

            ejercicio_1() {

                axios.post('/ejercicio_one/', {
					cadena: this.cadena
				}).then(res => {
			        let response = res.data;
			        this.$snotify.success('', 'Correcto', {
		                timeout: 4000,
		                showProgressBar: true,
		                closeOnClick: true,
		                pauseOnHover: true
		            });
                    this.cadena = response.cadena;
			    }).catch(error => {
			        
			    });


            },

            ejercicio_3() {

                axios.post('/ejercicio_three/', {
					array_three: this.array_three
				}).then(res => {
			        let response = res.data;
			        this.$snotify.success('', 'Correcto', {
		                timeout: 4000,
		                showProgressBar: true,
		                closeOnClick: true,
		                pauseOnHover: true
		            });
                    this.array_three = response.array_three;
			    }).catch(error => {
			        
			    });


            },

            handleFileUpload() {
                this.file = this.$refs.file.files[0];
            },

			addBusiness() {
                let formData = new FormData();
                formData.append('file', this.file);
                formData.append('business_name', this.negocios.business_name);
                formData.append('address', this.negocios.address);
                formData.append('short_name', this.negocios.short_name);
				axios.post('business/store',formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }, 
				}).then(res => {

					let response = res.data;
					this.$events.fire('filter-reset');
					this.$snotify.success(response.message, 'Correcto', {
						timeout: 4000,
						showProgressBar: true,
						closeOnClick: true,
						pauseOnHover: true
					});

                    let new_row = {};
					new_row = response.business;
					this.$events.fire('new-rol', new_row);

                    this.file = '';
					this.negocios = { 
						business_name: '',
					  	address: '',
                        short_name: ''
					};

				}).catch(err => {

					let response = err.response.data;
					console.log(response);
					this.$snotify.error(response.message, 'Error', {
						timeout: 4000,
						showProgressBar: true,
						closeOnClick: true,
						pauseOnHover: true
					});

					this.data_errors = err.response.data.errors;

				})

			},

            confirmarEliminar(business){

				this.$snotify.warning('Esta seguro de eliminarlo ?', 'Aviso', {
					timeout: 0,
					showProgressBar: false,
					closeOnClick: false,
					pauseOnHover: true,
					buttons: [
						{
							text: 'Si', 
							action: (toast) => {
								this.removeBusiness(business)
								this.$snotify.remove(toast.id); 
							}, 
							bold: true
						},
						{
							text: 'Cancelar', 
							action: (toast) => {
								this.$snotify.remove(toast.id); 
							}, 
							bold: true
						},
					]
				});
				
			},

            removeBusiness(business){

			    axios.delete('/business/'+business.id).then(res => {
			        this.onFilterReset();
			        let response = res.data;
			        let delete_row = {};
					delete_row = response.business;
					this.$events.fire('delete-rol', delete_row);
			        this.$snotify.success('Se elimino de la lista', 'Correcto', {
		                timeout: 4000,
		                showProgressBar: true,
		                closeOnClick: true,
		                pauseOnHover: true
		            });
			    }).catch(error => {
			        
			    });

			},

            cancelarEdit(){
                this.isEditing = false;
                this.not_logo = false;
                this.file = '',
				this.negocios = {
				    business_name: '',
				    address: '',
                    short_name: ''
				}
            },

			editBusiness(business){

				console.log("business:", business);
                this.isEditing = true;
                this.not_logo = true;
                this.negocios = {
                    id: business.id,
                	business_name: business.business_name,
					address: business.address,
					short_name: business.short_name,
					file: business.file,
                };
                console.log(this.negocios);

            },

            updateBusiness(){
                axios.put('/business/'+this.negocios.id, {
                  ...this.negocios
                }).then(res => {

                    this.isEditing=false;
                    this.not_logo = false;
                    let response = res.data;
                    this.onFilterReset();
                    this.$snotify.success(response.message, 'Correcto', {
						timeout: 4000,
						showProgressBar: true,
						closeOnClick: true,
						pauseOnHover: true
					});

                    this.file = '';
					this.negocios = { 
						business_name: '',
					  	address: '',
                        short_name: ''
					};

                }).catch(err => {

                	let response = err.response.data;
                    this.$snotify.error(response.message, 'Error', {
						timeout: 4000,
						showProgressBar: true,
						closeOnClick: true,
						pauseOnHover: true
					});
                    this.data_errors = err.response.data.errors;

                });

            },

			onFilterReset () {
                this.moreParams = {}
                Vue.nextTick( () => this.$refs.vuetable.refresh())
            },

            onPaginationData(paginationData) {
				this.$refs.pagination.setPaginationData(paginationData);
				//this.$refs.paginationInfo.setPaginationData(paginationData);
			},

			onChangePage (page) {
				this.$refs.vuetable.changePage(page)
			}

		},

		mounted() {
			this.$events.$on('filter-reset', e => this.onFilterReset())
        },

        computed: {

        	
        }
		
	}

	
</script>
