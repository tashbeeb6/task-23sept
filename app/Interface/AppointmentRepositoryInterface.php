<?php
namespace App\Interface;

interface AppointmentRepositoryInterface
{
 public function getall() ;
 public function create(array $data);
 public function FindById($id);
 public function update($id , array $data);
 public function delete($id);
public function getByCustomer($customerId);

}