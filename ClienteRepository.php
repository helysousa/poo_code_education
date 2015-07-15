<?php

require_once "Cliente.php";
require_once "ClienteRepositoryInterface.php";
require_once "src/autoload.php";

/**
 * Class ClienteRepository
 *
 */

class ClienteFakeRepository implements ClienteRepositoryInterface
{

    /**
     * @param $quantidade
     * @return array contendo $quantidade Clientes
     */
    public static function getClientes($quantidade)
    {


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
        }

        return $clientes;
    }

    public static function getJSONList($quantidade)
    {
        $clientes = ClienteFakeRepository::getClientes($quantidade);

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
}