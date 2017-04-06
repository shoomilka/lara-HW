<p> Hi, dear {{ $cleaner->first_name }} {{ $cleaner->last_name }}!</p> 
<p> You received a booking from {{ $customer->first_name }} {{ $cleaner->last_name }}</p>
<p> City:  {{$city->name}} </p>
<p> Date: {{ $booking->date }}</p>
<p> Time: {{ $booking->time }}</p>
<p> Hours: {{ $booking->hours }}</p>
<p> Good luck!</p>