<?php 

//namespace roomMates\hw4\views;

// Declaration for the View interface
interface View{
	public function render($data); // $data is just a catch all of any information that the page might need
}