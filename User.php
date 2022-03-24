<?php
echo "Chargement Class User";
class User{

    //Propriété ( Private )
    private $id_;
    private $login_;
    private $mdp_;


    //Méthode ( Public )
    public function __construct($id_,$NewLogin,$pass){
        $this->id_ = $id_;
        $this->login_ = $NewLogin;
        $this->mdp_ = $pass;
        
    }

    public function getNom(){
        return $this->login_;
    }

    public function seConnecter($UnMotDePass){
        
        if($UnMotDePass==$this->mdp_){
            return true;
        }else{
            return false;
        }

    }
}
?>