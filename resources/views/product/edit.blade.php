@extends('layouts.backend')
@section('title', 'Edit Product')

@section('content')
	
<edit-product :product="{{ json_encode($product) }}" :categories="{{ $categories }}" inline-template>
	
	<div>
<div class="container">
		<div class="level">
			<div class="level-left">
				<div class="level-item">
					<router-link to="/catalog">
						<a>
							<span class="icon">
							<i class="fa fa-angle-double-left"></i>
							</span> <span>Back</span>
						</a>						
					</router-link>
				</div>
			</div>
		</div>		
	 </div>

	<!-- page title -->
	<div class="original notice">
	  <div class="container">
	  	<div class="columns">
	  		<div class="column is-8 is-offset-2">
			  <p class="title is-3 white"><b>Edit @{{ product.name }}</b></p>		  			
	  		</div>
	  	</div>
	  </div>
	</div>

	<div class="container">
		<div class="columns">		
			<div class="column is-8 is-offset-2">			

			    {{-- editing form --}}
				<form method="PATCH" @submit.prevent="onSubmit">
					<p class="subtitle"><b>Name & Description</b></p>
					<div class="field">
						<label>Name:</label>
						<input type="text" class="input" v-model="product.name">
					</div>
					
					<p class="subtitle"><b>Measurements</b></p>


					<p class="subtitle"><b>Category / Type</b></p>									
					   <div class="field is-grouped">
						<div class="field-body">					
						  <div class="field">
							  <label>Current Category:</label>	
								<p class="subtitle is-5" v-for="category in product.categories">
									@{{ category.name }}
								</p>								  
						  </div>				
						  <div class="field">
						  <label>Change Category to:</label>							  
						  	<div class="control">
						    <div class="select">					    
							  <select>
						        <option>Select Category</option>
						        <option v-for="category in categories" :key="category.id">
						        	@{{ category.name }}
						        </option>
							  </select>					      
							</div>						  		
						  	</div>
						  </div>							
						</div>					  
					</div>
					<div class="field">
						<button class="button is-light" type="submit">
							SAVE
						</button>
					</div>											
				</form>		
				{{-- end of form --}}

					<p class="subtitle"><b>Product Images</b></p>	

					<div class="columns">
						<div class="column is-one-quarter" v-for="image in product.images">
							<img :src="'/'+image.thumbnail_path" alt="">
						</div>
					</div>		

					<div class="field">
						<button class="button" @click="showUpload = true" v-if="!showUpload">ADD IMAGES</button>
					</div>
					
					<div class="field" v-if="showUpload">
				    	<a class="is-pulled-right" @click="showUpload = false">
				    		<i class="fa fa-times fa-2x"></i>
				    	</a>					
					    <dropzone id="productImg" 
					    		  :headers="csrfHeader"
								  :url="'/product/'+id+'/images'"
					    		  v-on:vdropzone-success="showSuccess"
		  				          :use-font-awesome="true"
		  				          :thumbnail-height="130"
		  				          :thumbnail-width="130">
					    </dropzone>											    
					</div>	
					<p class="subtitle">Front, inside, back, side images</p>	
				
			</div>
		</div>	
	</div>			
	</div>

</edit-product>
	
@endsection