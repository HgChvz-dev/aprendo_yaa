<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminClasesVidController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "t_clases";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"id","name"=>"id"];
			$this->col[] = ["label"=>"Curso","name"=>"id_curso","join"=>"t_cursos,titulo_curso"];
			$this->col[] = ["label"=>"Titulo","name"=>"titulo_clase"];
			$this->col[] = ["label"=>"Detalle","name"=>"detalle_clase"];
			$this->col[] = ["label"=>"Clasificación","name"=>"clasifi_clase"];
			$this->col[] = ["label"=>"Tiempo Duiracion","name"=>"timedura_clase"];
			$this->col[] = ["label"=>"Imagen Pequeña","name"=>"imgchiqui_clase","image"=>true];
			$this->col[] = ["label"=>"Imagen Grande","name"=>"imggrand_clase","image"=>true];
			$this->col[] = ["label"=>"Genero","name"=>"genero_clase"];
			$this->col[] = ["label"=>"Video Repaso","name"=>"repasovid_clase","image"=>true];
			$this->col[] = ["label"=>"Video de la Clase","name"=>"clasevid_clase","image"=>true];
			$this->col[] = ["label"=>"Aprueba con","name"=>"ptaprueba_clase"];
			$this->col[] = ["label"=>"Creafo el","name"=>"feccrea_clase"];
			$this->col[] = ["label"=>"Lanzamiento el","name"=>"feclanza_clase"];
			$this->col[] = ["label"=>"Cuantas Preguntas","name"=>"cantpreg_clase"];
			$this->col[] = ["label"=>"Status","name"=>"status"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Creador','name'=>'id_creador','type'=>'hidden','value'=>'1','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Curso','name'=>'id_curso','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'t_cursos,titulo_curso'];
			$this->form[] = ['label'=>'Titulo Leccion','name'=>'titulo_clase','type'=>'text','validation'=>'required|min:3|max:70','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Detalle','name'=>'detalle_clase','type'=>'wysiwyg','validation'=>'required|min:15|max:500','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Clasificación Edad','name'=>'clasifi_clase','type'=>'text','validation'=>'required|min:2|max:20','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tiempo Duiracion','name'=>'timedura_clase','type'=>'time','validation'=>'required|date_format:H:i:s','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Imagen Pequeña - Max:500KB','name'=>'imgchiqui_clase','type'=>'upload','validation'=>'required|image|max:1024','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Imagen Grande - Max:2MB','name'=>'imggrand_clase','type'=>'upload','validation'=>'required|image|max:5120','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Dirigido a','name'=>'genero_clase','type'=>'text','validation'=>'required|min:2|max:25','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Video Repaso - Max:15MB','name'=>'repasovid_clase','type'=>'upload','validation'=>'required|max:15360','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Video Leccion - Max:100MB','name'=>'clasevid_clase','type'=>'upload','validation'=>'required|max:122880','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Aprueba con','name'=>'ptaprueba_clase','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Creado el','name'=>'feccrea_clase','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Lanzamiento el','name'=>'feclanza_clase','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Numero de Preguntas','name'=>'cantpreg_clase','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Status','name'=>'status','type'=>'hidden','value'=>'Activo','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Curso','name'=>'id_curso','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'t_cursos,titulo_curso'];
			//$this->form[] = ['label'=>'Titulo','name'=>'titulo_clase','type'=>'text','validation'=>'required|min:3|max:70','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Detalle','name'=>'detalle_clase','type'=>'text','validation'=>'required|min:15|max:250','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Clasificación','name'=>'clasifi_clase','type'=>'text','validation'=>'required|min:2|max:20','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Tiempo Duiracion','name'=>'timedura_clase','type'=>'time','validation'=>'required|date_format:H:i:s','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Imagen Pequeña','name'=>'imgchiqui_clase','type'=>'text','validation'=>'required|image|max:1024','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Imagen Grande','name'=>'imggrand_clase','type'=>'text','validation'=>'required|image|max:5120','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Genero','name'=>'genero_clase','type'=>'text','validation'=>'required|min:2|max:25','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Video Repaso','name'=>'repasovid_clase','type'=>'upload','validation'=>'required|max:15360','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Video de la Clase','name'=>'clasevid_clase','type'=>'upload','validation'=>'required|max:113000','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Aprueba con','name'=>'ptaprueba_clase','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Creafo el','name'=>'feccrea_clase','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Lanzamiento el','name'=>'feclanza_clase','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Cuantas Preguntas','name'=>'cantpreg_clase','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Status','name'=>'status','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = NULL;


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }



	    //By the way, you can still create your own method in here... :) 


	}