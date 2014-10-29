<?php

interface DAO {

	public function insert( $objet);

	public function delete($objet);

	public function change($objetDepart, $objetFinal);

	public function all();

	public function selectWhere(array $criteres);


}