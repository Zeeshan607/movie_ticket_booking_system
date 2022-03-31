{{--{{dd($reservations->toArray())}}--}}

@foreach($beats as $key=>$beat)

<tr>




        <td id="{{$key}}">{{$beat->name}}</td>
             <td id="" class="day-box">
                 <div class="shift-box-1 text-center">
                     <span>AM</span>
                 </div>
                 <div class="shift-box-2 text-center">
                     <span>PM</span>

                 </div>
             </td>

    @foreach($period as $dt)
        <td style="background-color:#D3F194;" class="day-box">
            <div class="shift-box-1">
        @foreach($reservations as $reservation)
        @if(date('Y-m-d',strtotime($reservation->date)) == date('Y-m-d',strtotime($dt)) && $reservation->length=="morning")

        <a data-toggle="tooltip"   class='createdDiv booked ' data-html="true" data-placement="left" title="
                                            <p>Reservation Date: {{date('m-d-Y',strtotime($reservation->date)) }}</p>
                                            <p>Guide Name: {{$reservation->guide_names }}</p>
                                            <p>Number of people: {{$reservation->num_of_people==null?'':$reservation->num_of_people }}</p>
                                            <p>Customer Name: {{$reservation->name}}</p>
                                               <p>Shift:AM</p>
                                            " href="" target="_blank">
            <i class="fa fa-calendar-check-o"></i>
        </a>
                 @break
        @endif
            @endforeach
            </div>
            <div class="shift-box-2">
            @foreach($reservations as $reservation)
                @if(date('Y-m-d',strtotime($reservation->date)) == date('Y-m-d',strtotime($dt)) && $reservation->length=="afternoon" )

                    <a data-toggle="tooltip"   class='createdDiv booked' data-html="true" data-placement="left" title="
                                            <p>Reservation Date: {{ date('m-d-Y',strtotime($reservation->date)) }}</p>
                                            <p>Guide Name: {{$reservation->guide_names }}</p>
                                            <p>Number of people: {{$reservation->num_of_people==null?'':$reservation->num_of_people }}</p>
                                            <p>Customer Name: {{$reservation->name}}</p>
                                               <p>Shift:PM</p>

                                            " href="" target="_blank">
                        <i class="fa fa-calendar-check-o"></i>
                    </a>
                    @break
                @endif
            @endforeach
            </div>
        </td>


    @endforeach
</tr>

@endforeach


