<?php

namespace App\Repository;

use App\Interface\AppointmentRepositoryInterface;
use App\Models\Appointment;

class AppointmentRepository implements AppointmentRepositoryInterface{

public function getAll(){

return Appointment::all();

}

public function create( array $data){

return Appointment::create($data);

}

public function FindById($id)
{
    
return Appointment::FindOrFail($id);
}
public function update($id, array $data)
{
    $appointment = $this->findById($id);

    $appointment->update($data);

    return $appointment;
}
public function delete($id){
    return $this->FindById($id)->delete();
}
public function getByCustomer($customerId)
{
    return Appointment::where('customer_id', $customerId)
        ->with(['service', 'provider'])
        ->get();
}
}