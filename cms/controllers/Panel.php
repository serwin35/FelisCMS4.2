<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends FC_Controller {

    public function __construct(){
        parent::__construct();
        @FC_Request::loadModel(array("Default_model"));
        // Jeśli niezalogowany to przenosi na logowanie
        if(!$this->ion_auth->logged_in())
        	redirect(base_url("zaloguj.html"), 'refresh');
    }

	public function index(){
		$query["hotele"] = $this->db->count_all('hotels');
		$query["pakiety"] = $this->db->count_all('pakiet');

		$user = $this->ion_auth->user()->row();
		$query["userPoint"] = $user->point;

		$this->smarty->view("account/index.tpl", $query);
	}

	public function dane(){
        $messages = array('boxClass' => "alert-danger", "text" => "Test");

		$query = $this->ion_auth->user()->row();

        $this->smarty->assigns("messages", $messages);
		$this->smarty->view("account/you.tpl", $query);
	}



 /*
  *
  *	Rezerwacje
  *
  */

// Rezerwacje
	public function rezerwacje(){
		$user = $this->ion_auth->user()->row();
		$rezerwacje = $this->db->get_where("reservation", array("r_uid"=>$user->id))->result_array();

		foreach($rezerwacje as $rezerwacja){
			$pakiet = array();
            $pakiet = $this->db->get_where("pakiet", array("p_id"=>$rezerwacja["r_pid"]))->row_array() + $rezerwacja;
            $query["rezerwacje"][] = $pakiet;
		}

		$this->smarty->view("account/rezerwacje.tpl", $query);
	}

// Rezerwacja
	public function rezerwacja($id){
		$user = $this->ion_auth->user()->row();
		$query["rezerwacja"] = $this->db->get_where("reservation", array("r_id"=>$id, "r_uid"=>$user->id))->row_array();
        $query["pakiet"] = $this->db->get_where("pakiet", array("p_id"=>$query["rezerwacja"]["r_pid"]))->row_array();
        $query["hotel"] = $this->db->get_where("hotels", array("id"=>$query["rezerwacja"]["r_hid"]))->row_array();

        if($query["rezerwacja"]["r_status"] == 0){
        	$price = $query["pakiet"]["p_price"] * 0.10;

            $przelewy24 = @FC_DB::getData('payment_metods', array("name"=>'przelewy24'));
            $price = $price * 100;
            $sygnatura = "urloping/{$user->id}/{$query["rezerwacja"]["r_pid"]}/{$id}"."-".time();

            $method[] = array('name' => "p24_session_id", 'value' => $sygnatura);
            $method[] = array('name' => 'p24_id_sprzedawcy', 'value' => $przelewy24["param_1"]);
            $method[] = array('name' => 'p24_kwota', 'value' => $price);
            $method[] = array('name' => "p24_crc", 'value' => md5("{$sygnatura}|{$przelewy24["param_1"]}|{$price}|{$przelewy24["param_2"]}"));
            $method[] = array('name' => "p24_opis", 'value' => "Zamowienie w serwisie Blue-NET: "."urloping/{$user->id}/{$query["rezerwacja"]["r_pid"]}/{$id}");
            $method[] = array('name' => "p24_kraj", 'value' => "PL");
            $method[] = array('name' => "p24_language", 'value' => "pl");
            $method[] = array('name' => "p24_return_url_ok", 'value' => base_url()."panel/weryfikuj_przelewy24.html");
            $method[] = array('name' => "p24_return_url_error", 'value' => base_url()."panel/weryfikuj_przelewy24.html");

            $method[] = array('name' => "p24_klient", 'value' => $user->first_name.' '.$user->last_name);
            $method[] = array('name' => "p24_adres", 'value' => $user->address);
            $method[] = array('name' => "p24_miasto", 'value' => $user->city);
            $method[] = array('name' => "p24_kod", 'value' => $user->post_code);
            $method[] = array('name' => "p24_email", 'value' => $user->email);

            $query["payments"] = $method;

            // Datownik (teraz, termin płatności)
            date_default_timezone_set('europe/warsaw');
            $data = "%Y-%m-%d";
            $now = mdate($data);

            $przelew = @FC_DB::getDataSelect('p24_session_id', 'przelewy24', array('p24_session_id'=>$sygnatura), 'p24_session_id');
            if(!$przelew){
                $_p24 = array('p24_uid'=>$user->id, 'p24_pid'=>$id, 'p24_session_id'=>$sygnatura, 'p24_kwota'=>$price, 'p24_data'=>$now);
                @FC_DB::insert('przelewy24', $_p24);
            }

            //$urlForm = "https://secure.przelewy24.pl/index.php";
            $query["urlForm"] = "https://sandbox.przelewy24.pl/index.php";
		}

		$this->smarty->view("account/rezerwacja.tpl", $query);
	}

// Rezerwacj
	public function rezerwuj($id){
		$messages = false;
		$user = $this->ion_auth->user()->row();

		if($this->input->post("r_date")){
			$data = array("r_date" => $this->input->post("r_date"), "r_uid" => $user->id, "r_pid" => $id, "r_status" => 0, "r_hid" => $this->db->get_where("pakiet", array("p_id"=>$id))->row("p_hotels"));

	        $sql = $this->db->insert_string("reservation", $data);
	        $status = $this->db->query($sql);

	        if($status == 1){
				$messages = array('boxClass' => "alert-success", "text" => "Rezerwacja dokonana!");
	        }
	        else{
				$messages = array('boxClass' => "alert-danger", "text" => "Rezerwacja nie została dokonana!");
	        }

		}

		$query["messages"] = $messages;
		$this->smarty->view("account/rezerwuj.tpl", $query);
	}

// Sprawdzenie daty
	public function rezerwuj_data(){
        $response = array('status' => 'ok', 'message' => array());
        $date = $this->input->post("date");
        if($date){}else $response['status']="error";
        $response["message"]['action'] = $query;
        $response["message"]['post'] = $date;
		return $this->output->set_content_type('application/json', 'utf-8')->set_output(json_encode($response));
	}

// Faktury Płatności - Weryfikuj płatność
    public function weryfikuj_przelewy24(){
		$user = $this->ion_auth->user()->row();
        $user_id = $user->id;
        $bn = false;
        //Przelewy24 dane
        $przelewy24 = @FC_DB::getData('payment_metods', array("name"=>'przelewy24'));

        // Weryfikacja przelewu
        $p24Post = @FC_Request::post();
        if(isset($p24Post)){
            date_default_timezone_set('europe/warsaw');
            $p24_ver["p24_order_id_full"]    = $p24Post["p24_order_id_full"];
            if(isset($p24Post["p24_error_code"])) $p24_ver["p24_error_code"]       = $p24Post["p24_error_code"];
            $p24_ver["p24_order_id"]         = $p24Post["p24_order_id"];
            $p24_ver["p24_karta"]            = $p24Post["p24_karta"];
            $p24_ver["p24_kwota"]            = $p24Post["p24_kwota"];

            $sygnatura = explode("-", $p24Post["p24_session_id"]);
            $sygnatura = explode("/",$sygnatura[0]);

            //$p24_ver["p24_uid"]
            $p24 = @FC_DB::update('przelewy24', $p24_ver, array('p24_session_id' => $p24Post["p24_session_id"]));
            @FC_Request::loadModel("payments/przelewy24");
            $felisp24 = Przelewy24::weryfikuj($przelewy24['param_1'], $p24Post["p24_session_id"], $p24_ver["p24_order_id"], $przelewy24['param_2'], $p24_ver["p24_kwota"]);
            $przelew24 = @FC_DB::getData('przelewy24', array('p24_session_id' => $p24Post["p24_session_id"]));
            $bn["payments"] = $felisp24;

            if($felisp24 == TRUE){
                @FC_DB::update('reservation', array('r_status'=>1, 'r_payment'=> $przelewy24["id"]), array('r_id'=>$sygnatura[3]));
            }
            else @FC_DB::update('przelewy24', array('p24_error_code' =>  $p24Post["p24_error_code"]), array('p24_order_id' => $p24_ver["p24_order_id"]));
        }

        $this->smarty->view('account/weryfikacja.tpl', $bn);
    }


 /*
  *
  *	Koszykowe
  *
  */

// Koszyk
    public function koszyk(){
        $basket_items = @FC_BASKET::total_items();

        if(!empty($basket_items)){
            $basket_total = @FC_BASKET::total();
            $basket_item = @FC_BASKET::contents();
            $this->smarty->assign("basket_total", $basket_total);
            $this->smarty->assign("basket_item", $basket_item);
        }

        $this->smarty->assign("basket_items", $basket_items);
        $this->smarty->view('account/basket.tpl');
    }

// Koszyk dodawanie
    public function dodaj(){
        $response = array('status' => 'ok','message' => array());
        $date = @FC_Request::post("date");
        if($date){}else $response['status']="error";
        $content = @FC_BASKET::contents();
        $basket = $this->isInCart($content, "id", $date["id"]);
        if($basket == 1){
            $rowid = $this->isInCartDate($content, "id", $date["id"], "rowid");
            $qty = $this->isInCartDate($content, "id", $date["id"], "qty");
            $data = array('rowid' => $rowid,'qty' => ++$qty);
            $action = @FC_BASKET::update($data);
        }
        else{
            $action = @FC_BASKET::insert($date);
        }
        $response["message"]['id'] = $action;
        $response["message"]['post'] = $date;
        $referer = @FC_Request::server("HTTP_REFERER");
        header('Location: '.$referer);
    }

// Koszyk usuwanie wpisu
    public function remove() {
        $response = array('status' => 'ok', 'message' => array());
        $date = @FC_Request::post("date");
        if($date){}else $response['status']="error";
        $data = array('rowid' => $date["id"],'qty' => 0);
        $action = @FC_BASKET::update($data);
        $response["message"]['id'] = $action;
        $response["message"]['post'] = $date;
        $referer = @FC_Request::server("HTTP_REFERER");
        header('Location: '.$referer);
    }

// Koszyk zwiększenie sztuk
    public function qty_add() {
        $response = array('status' => 'ok', 'message' => array());
        $date = @FC_Request::post("date");
        if($date){}else $response['status']="error";
        $data = array('rowid' => $date["id"], 'qty' => ++$date["qty"]);
        $action = @FC_BASKET::update($data);
        $response["message"]['id'] = $action;
        $response["message"]['post'] = $date;
        $referer = @FC_Request::server("HTTP_REFERER");
        header('Location: '.$referer);
    }

// Koszyk zmniejszenie sztuk
    public function qty_remove() {
        $response = array('status' => 'ok', 'message' => array());
        $date = @FC_Request::post("date");
        if($date){}else $response['status']="error";
        $data = array('rowid' => $date["id"], 'qty' => --$date["qty"]);
        $action = @FC_BASKET::update($data);
        $response["message"]['id'] = $action;
        $response["message"]['post'] = $date;
        $referer = @FC_Request::server("HTTP_REFERER");
        header('Location: '.$referer);
    }

// Koszyk czyszczenie
    public function wyczysc(){
        $referer = @FC_Request::server("HTTP_REFERER");
        $action = @FC_BASKET::destroy();
        print $action;
        $referer = @FC_Request::server("HTTP_REFERER");
        header('Location: '.$referer);
    }

// Sprawdzanie czy produkt jest w koszyku
    function isInCart($array, $key, $value){foreach($array as $k => $v){if($v[$key] == $value){return TRUE;}}}

// Pobieranie rowid produktu z koszyka
    function isInCartDate($array, $key, $value, $re){foreach($array as $k => $v){if($v[$key] == $value){return $v[$re];}}}



}