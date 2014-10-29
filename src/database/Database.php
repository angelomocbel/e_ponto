<?php
    define("SERVIDOR", "localhost");
    define("USUARIO", "root");
    define("SENHA", "");
    define("BANCO", "e_ponto");
class Database {
    protected $conexao = null;

    public function __construct() {
        $this->conectar();
    }
    
    public function __destruct() {
        $this->desconectar();
    }
    public function conectar() {
        $this->conexao = new mysqli(SERVIDOR, USUARIO, SENHA, BANCO);
        if (mysqli_connect_errno()) {
            echo "Não foi possível conectar-se ao banco de dados: " . mysqli_connect_error();
        }
        $this->conexao->query("SET NAMES 'utf8'");
        $this->conexao->query('SET character_set_connection=utf8');
        $this->conexao->query('SET character_set_client=utf8');
        $this->conexao->query('SET character_set_results=utf8');
    }

    public function desconectar() {
        $this->conexao->close();
    }

    public function realizar($pedido) {
        return $this->converter_resultado_tabela($this->conexao->query($pedido));
    }
    
    private function converter_resultado_tabela($resultado) {
        $tabela = array();
        $n = 0;
        if (!strcmp(gettype($resultado), "boolean")) return $resultado;
        while ($linha = $resultado->fetch_assoc()) {
            $linha_tabela = array();
            $c = 0;
            while ($c < $resultado->field_count) {
                $campo = $resultado->fetch_field_direct($c);
                $linha_tabela[$campo->name] = $linha[$campo->name];
                $c++;
            }
            $tabela[$n] = $linha_tabela;
            $n++;
        }
        return $tabela;
    }
    
    private function salvar($obtejo){
        $pedido = "INSERT INTO ".$obtejo->getTabela()." (".$objeto->getCampos().") VALUES(".$objeto->getValores().");";
        return $this->realizar($pedido);
    }
    
    private function excluir($objeto){
        $pedido = "DELETE FROM ".$objeto->getTabela()." WHERE = ".$objeto->getId().";";
        return $this->realizar($pedido);
    }
    
    private function atualizar($objeto){
        $pedido = "UPDATE ".$objeto->getTabela()." SET ".$objeto->getValoresUpdate()." WHERE id = "
                .$objeto->getId().";";
        return $this->realizar($pedido);
    }
    
    public function login($usuario, $senha){
        $senha = md5($senha);
        $pedido  = "SELECT * FROM servidor WHERE usuario = '$usuario' AND senha = '$senha';";
        return $this->realizar($pedido);
    }
    //adicionar novo servidor
    public function adicionar_servidor($servidor){
        $pedido = "SELECT usuario FROM servidor WHERE usuario = '$servidor->getUsuario()';";
        $resultado = $this->realizar($pedido);
        if(count($resultado) == 0){
            if ($this->salvar($servidor)) {
                return 1; //salvo com sucesso
            }else{
                return 0; //erro ao salvar
            }
        }
        return 2; //nome de usuário já está cadastrado
    }
    //adicionar novo departamento
    public function adicionar_departamento($departamento){
        $pedido = "SELECT nome FROM departamento WHERE nome = '$departamento->getNome()';";
        $resultado = $this->realizar($pedido);
        if(count($resultado) == 0){
            if($this->salvar($departamento)){
                return 1; //salvo com sucesso
            }else{
                return 0; //erro ao salvar
            }
        }
        return 2; //nome de departamento já está cadastrado
    }
}