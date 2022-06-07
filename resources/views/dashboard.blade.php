<style type="text/css">
    
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: auto;
}

td, th {

  border: 1px solid #dddddd;
  text-align: center;

  



}

tr:nth-child(even) {
  background-color: #dddddd;

}

</style>

<?php 

use \Illuminate\View\View;
use App\Models\orders;

 ?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <?php 
                    $data = orders::where('name', 'matthew'); 
                    $user = Auth()->user()->name;
                    $orderdata = DB::table('orders')->where('rname', $user)->get();



                   

                    ?>

                    <table>
                        <table>
  <tr>
    <th>customer</th>
    <th>address</th>
    <th>order at</th>
  </tr>
                    <!--  Generate table -->
                   @foreach($orderdata as $key => $value){
                       
                        <tr>
                        <td>{{ $value->rname }}</td>
                        <td>{{ $value->caddress }}</td>
                        <td>{{ $value->created_at }}</td>
                        </tr>
                    
                    }
                    @endforeach
                    </table>


                       
                </div>
            </div>


        </div>
    </div>


</x-app-layout>
