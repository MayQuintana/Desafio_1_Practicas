<?php
class SucursalesController extends AppController{


public function index(){
    
    }

public function listar($page = 1){
    
      $this->lista = (new Sucursales)->getdatos($page);    
}

public function editar($id){

    $editar = new Sucursales();
 
        //se verifica si se ha enviado el formulario (submit)
        if (Input::hasPost('sucursales')) {
 
            if ($editar->update(Input::post('sucursales'))) {
                 Flash::valid('Operación exitosa');
                //enrutando por defecto al index del controller
                return Redirect::to();
            }
            Flash::error('Falló Operación');
            return;
        }

        //Aplicando la autocarga de objeto, para comenzar la edición
        $this->sucursales = $editar->find_by_id((int) $id);
}

public function crear(){
    
    if (Input::hasPost('sucursales')) {
        /**
         * se le pasa al modelo por constructor los datos del form y ActiveRecord recoge esos datos
         * y los asocia al campo correspondiente siempre y cuando se utilice la convención
         * model.campo
         */
        $create = new Sucursales(Input::post('sucursales'));
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
    
        if ((new Sucursales)->delete((int) $id)) {
            Flash::valid('Operación exitosa');
        
    } else {
            Flash::error('Falló Operación');
    }
    //Flash::warning("Advertencia: No ha iniciado sesión en el sistema");

    //enrutando por defecto al index del controller
    return Redirect::to();

    }


public function ver($id){

    $see = new Sucursales();
    $this->see = $see->find_by_id((int) $id);

        
}
}