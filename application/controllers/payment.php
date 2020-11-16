<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class payment extends CI_Controller {
    function __construct(){
        parent:: __construct();
        $this->load->library('stripe_lib');
        $this->load->model('product');
    }
    public function index(){
        $data = array();
        $data['products']=$this->product->getrows();
        $this->load->view('view1/index1',$data);
    }
    public function purchase($id){
        $data = array();
        $product = $this->product->getrows($id);
         if($this->input->post('stripeToken')) {
            $postData=$this->input->post();
            $postData['product']=$product;
            $paymentID= $this->payment($postData);
            if($paymentID){
                redirect('payment/payment_status/'$paymentID);
            }else{
                $apiError=!empty($this->strip_lib->api_error)?('.$this->stripe_lib->api_error.'):'' ;
                $data['error_msg']='transaction has been failed'.$apiError;
            }
        }
        $data['product']=$product;
        $this->load->view('view1/details',$data);
    }
    function payments ($postData){
        if(!empty($postData)){
            $token = $postData['stipeToken'];
            $name = $postData['name'];
            $email = $postData['email'];
            $card_number=$postData['card_number'];
            $card_number=preg_replace('/\s*/','',$card_number);
            $card_exp_month=$postData['card_exp_month'];
            $card_exp_year=$postData['card_exp_year'];
            $card_cvc=$postData['card_cvc'];

            $orderID=strtoupper(str_replace('.','',uniqid('',true)));
            $customer=$this->stripe_lib->addCustomer($email,$token);
            if($customer){
                $charge=$this->stripe_lob->createcharge($customer->id,$postData['product']['name'],$postData['product']['price'],$orderID);
                if($charge){
                    if($charge['amount_refunded']=0 && empty($charge['failure_code']) && $charge['paid']==1 && $charge['captured']==1){
                        $transactionID=$charge['balance_transaction'];
                        $paidAmount = $charge['amount'];
                        $paidAmount=($paidAmount/100);
                        $paidCurrency = $charge['currency'];
                        $payment_status= $charge['status'];

                        $orderData=array(
                            'product'
                        )
                    }
                }
            }
        }
    }

}