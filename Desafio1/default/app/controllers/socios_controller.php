<?php
class SociosController extends AppController{


public function index(){
    
    }

public function listar($page = 1){
    
      $this->lista = (new Socios)->getdatos($page);    
}

public function editar($id){

    $editar = new Socios();
 
        //se verifica si se ha enviado el formulario (submit)
        if (Input::hasPost('socios')) {
 
            if ($editar->update(Input::post('socios'))) {
                 Flash::valid('Operación exitosa');
                //enrutando por defecto al index del controller
                return Redirect::to();
            }
            Flash::error('Falló Operación');
            return;
        }

        //Aplicando la autocarga de objeto, para comenzar la edición
        $this->socios = $editar->find_by_id((int) $id);
}

public function crear(){
    
    if (Input::hasPost('socios')) {
        /**
         * se le pasa al modelo por constructor los datos del form y ActiveRecord recoge esos datos
         * y los asocia al campo correspondiente siempre y cuando se utilice la convención
         * model.campo
         */
        $create = new Socios(Input::post('socios'));
        //En caso que falle la operación de guardar
        if ($create->create()) {
            Flash::valid('Operación exitosa');
            //Eliminamos el POST, si no queremos que se vean en el form
            Input::delete();
            return;
        }

        Flash::error('Falló Operación');
    }
}

public function eliminar($id){
    
        if ((new Socios)->delete((int) $id)) {
            Flash::valid('Operación exitosa');
        
    } else {
            Flash::error('Falló Operación');
    }
    //Flash::warning("Advertencia: No ha iniciado sesión en el sistema");

    //enrutando por defecto al index del controller
    return Redirect::to();

    }


public function ver($id){

    $see = new Socios();
    $this->see = $see->find_by_id((int) $id);


}
}