<?php 
	abstract class conexao
	{
		protected $db;
		
		function __construct()
		{
			//dentro de parametro : banco, o servidor, o nome da base de dados e charset
			$parametro = "mysql:host=localhost;dbname=academia_km;charset=utf8mb4";
			try
			{
				$this->db = new PDO($parametro, "root", "");
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch (PDOException $e)
			{
				//die($e->getMessage());
				die("Erro ao abrir conexão");
			}
		}
	}
?>