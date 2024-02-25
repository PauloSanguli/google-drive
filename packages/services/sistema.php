<?php
    include("server/querys_db.php");
    include("server/connection_db.php");
    include("login.php");
    include("storage_control.php");
    include("auth.php");
    
    $connection_parameter = new DB("localhost", "root", "google_drive");

    class App{
        private $connection_db;
        function __construct()
        {
            $this->space_total_storage = 500;
            // $this->tx_mb = 0.0009765625;
            $this->connection_db = $GLOBALS["connection_parameter"]->connect();
        }

        public function cadastrar_usuario($nome, $pwd, $email){
            /*inserting user in db*/

            $response_db = insert_query("usuario", "'$nome','$pwd','$email'",$this->connection_db);
            if($response_db){
                echo "usuario criado";
            }else{
                echo "usuario não criado";
            }
        }

        public function armazenar_arquivo($_file_tmp, $_filesize, $_filename){
            /* inserting files in db */
            $usuario_id = get_user_logged();
            
            $checando_espaco = check_storage($_filesize,$usuario_id[0],$this->connection_db);
            if($checando_espaco){
                $fp = fopen($_file_tmp, "rb");
                $_file_readed = fread($fp, $_filesize);
                $_file_binary = addslashes($_file_readed);
                fclose($fp);
                
                $query = "INSERT INTO `arquivo`(nome_ficheiro,ficheiro,usuario_id,tamanho) VALUES('$_filename','$_file_binary',$usuario_id[0],$_filesize)";
                $response_db = execute_query($query,$this->connection_db);
                
                if($response_db){
                    echo "arquivo armazenado";
                }else{
                    echo "arquivo não armazenado";
                }
            }else{
                echo "espaco indisponivel";
            }
        }

        public function ver_arquivos(){
            /* see all files */
            $usuario_id = get_user_logged();

            $query_select = $this->connection_db->prepare("SELECT * FROM `arquivo` WHERE `usuario_id`='$usuario_id[0]'");
            $query_select->execute();

            $result = $query_select->fetchAll();

            return $result;
        }

        public function compartilhar_arquivo($arquivo_id, $email_amigo){
            /* share files to friends */
            $usuario_id = get_user_logged();

            $resp = insert_query("compartilhados", "$usuario_id[0],$arquivo_id,'$email_amigo'",$this->connection_db);
            if($resp){
                echo "arquivo compartilhado";
            }else{
                echo "arquivo não compartilhado";
            }
        }

        public function space_storage(){
            /* see the space free */
            $usuario_id = get_user_logged();

            $result = select_distint_query($usuario_id[0], "usuario", $this->connection_db)["espaco"];

            $dic_storage_info = Array("free"=>$result, "used"=>$this->space_total_storage-$result);

            return $dic_storage_info;
        }

        public function arquivos_compartilhados(){
            /* files shared */
            $usuario_id = get_user_logged();

            $query_fk = $this->connection_db->prepare("SELECT * FROM `compartilhados` WHERE `usuario_id`='$usuario_id[0]'");
            $query_fk->execute();
            return $query_fk->fetchAll();
        }

        public function comentar($conteudo,$arquivo_id,$email){
            /* comment file */

            $resp = insert_query("comentarios","'$conteudo',$arquivo_id,'$email'",$this->connection_db);
            if($resp){
                echo "comentado";
            }else{
                echo "não comentado";
            }
        }

        public function count_files(){
            $user_id = get_user_logged()[0];

            return count_f("arquivo", $user_id, $this->connection_db);
        }

        public function pegar_comentarios($arquivo_id){
            /* fetch comments */

            $query = $this->connection_db->prepare("SELECT * FROM `comentarios` WHERE `arquivo_id`=$arquivo_id");
            $query->execute();
            return $query->fetchAll();
        }

        public function responder_comentario($conteudo,$comentario_id, $email){
            /* answer comments */

            $resp = insert_query("respostas", "'$conteudo',$comentario_id,'$email'", $this->connection_db);
            if($resp){
                echo "resposta enviada";
            }else{
                echo "resposta não enviada";
            }
        }

        public function datas_user(){
            $user_id = get_user_logged()[0];

            return select_distint_query($user_id, "usuario", $this->connection_db);
        }

        public function login($email, $pwd){
            /* login user */
            credenciais_usuario($email, $pwd, $this->connection_db);
        }

        public function delete_file($id, $tamanho){
            /* delete file by id */
            $usuario_id = get_user_logged();
            $infoStorage = $this->space_storage()["free"];
            $tamanho = convertData($tamanho);
            
            delete_query("arquivo", $id, $this->connection_db);

            query_update_storage($infoStorage+$tamanho, $usuario_id[0], $this->connection_db);
        }
    }
?>
