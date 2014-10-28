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

        if (!strcmp(gettype($resultado), "boolean")) {
            return $resultado;
        }
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
    
    public function salvar($obtejo){
        $pedido = "INSERT INTO ".$obtejo->getTabela()." (".$objeto->getCampos().") VALUES(".$objeto->getValores().");";
        return $this->realizar($pedido);
    }
    
    public function excluir($objeto){
        $pedido = "DELETE FROM ".$objeto->getTabela()." WHERE = ".$objeto->getId().";";
        return $this->realizar($pedido);
    }
    
    public function atualizar($objeto){
        $pedido = "UPDATE ".$objeto->getTabela()." SET "."";
    }
}
