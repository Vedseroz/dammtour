<?php
        //con esta vista se cargan todos los templates para no tener que cargar todo. 
        
        $this->load->view('navbar');
		$this->load->view('sidebar');
        $this->load->view('header');
        $this->load->view($vista,$this->data);
		$this->load->view('footer');