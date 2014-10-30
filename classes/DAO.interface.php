<?php

interface DAO {

	/*
	* Insert un objet dans la bdd
	*/
	public function insert( $objet);

	/*
	* supprime un objet dans la bdd
	*/
	public function delete($objet);

	/*
	* modifie un objet dans la bdd
	*/
	public function change($objetDepart, $objetFinal);

	/*
	* renvoie tous les objet de la table
	*/
	public function all();

	/*
	* Effectue une selection sur la table selon les critères passés en paramètre
	*/
	public function selectWhere(array $criteres);


}