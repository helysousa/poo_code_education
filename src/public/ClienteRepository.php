<?php

require_once "Cliente.php";
require_once "ClienteRepositoryInterface.php";
require_once "autoload.php";

/**
 * Class ClienteRepository
 *
 */

class ClienteFakeRepository implements ClienteRepositoryInterface
{

    const QUANTIDADE_PADRAO = 10;
    const ARQUIVO_CLIENTES = "clientes.json";
   
    /**
     * Factory (faker) de clientes
     * @param $quantidade
     * @return array contendo $quantidade de Clientes
     */
    private static function gerarNovosClientes($quantidade = self::QUANTIDADE_PADRAO)
    {
        
        // se existir um arquivo de clientes, não fazer nada
        
        if (!file_exists(self::ARQUIVO_CLIENTES)) 
        {    
            // popular a lista com novos clientes
            for ($i=1;$i<=$quantidade;$i++)
            {
                $clientes[$i] = new Cliente();
                $faker = Faker\Factory::create();
    
                $clientes[$i]
                    ->setCodigo($i)
                    ->setNome($faker->name)
                    ->setCPF($faker->numerify('###.###.###-##'))
                    ->setEndereco($faker->address)
                    ->setBairro($faker->citySuffix)
                    ->setCidade($faker->city)
                    ->setUF(Faker\Provider\en_US\Address::stateAbbr())
                    ->setCep($faker->postcode);
            };
            
            // persistir clientes criados
            $fp = fopen(self::ARQUIVO_CLIENTES, "w");
            fwrite($fp, self::toJSONList($clientes));
            fclose($fp);
        }
        
    }

    /**
    * Retorna  uma lista de clientes
    * @param $quantidade
    * @return Um array contendo $quantidade de Clientes
    */

    public static function getClientes () 
    {       
        
        // ler clientes persistidos
        $clientes = self::loadFromJSONList(self::getJSONList());

        return $clientes;
    }

    /**
    * Retorna uma estrutura json de clientes
    * @param $quantidade
    * @return Um json contendo $quantidade de Clientes
    */

    public static function toJSONList($clientes)
    {
       
        foreach ($clientes as $cliente)
        {
            $lista[] = array( "Codigo"   => $cliente->getCodigo(),
                              "Nome"     => $cliente->getNome(),
                              "CPF"      => $cliente->getCPF(),
                              "Endereco" => $cliente->getEndereco(),
                              "Bairro"   => $cliente->getBairro(),
                              "Cidade"   => $cliente->getCidade(),
                              "UF"       => $cliente->getUF(),
                              "CEP"      => $cliente->getCEP()
            );
        }

        return json_encode($lista);
    }
    
    /**
    * Carrega uma estrutura json de clientes em um array
    * @param $quantidade
    * @return Um array de clientes
    */

    public static function loadFromJSONList($jsonClientes)
    {
        
        // converte json para array
        $lista  = json_decode($jsonClientes, true);
        
        // inicializa variáveis temporárias
        $i = 0;
        $clientes = array();
        
        // carrega array de clientes a partir da lista convertida
        foreach($lista as $registro)
        {
            $clientes[$i] = new Cliente();
            
            $clientes[$i]->setCodigo($registro["Codigo"])
                        ->setNome($registro["Nome"])
                        ->setCPF($registro["CPF"])
                        ->setEndereco($registro["Endereco"])
                        ->setBairro($registro["Bairro"])
                        ->setCidade($registro["Cidade"])
                        ->setUF($registro["UF"])
                        ->setCEP($registro["CEP"]);
                        
           $i++;
        };
              
        // retorna array de clientes
        return $clientes;
     
    }
    
    public static function getJSONList()
    {
        if(!file_exists(self::ARQUIVO_CLIENTES)) 
        {
            self::gerarNovosClientes();
        }
        
        $fp = fopen(self::ARQUIVO_CLIENTES,"r");
        $jsonString = fread($fp,filesize(self::ARQUIVO_CLIENTES));
        fclose($fp);
        
        return $jsonString;
    }
}