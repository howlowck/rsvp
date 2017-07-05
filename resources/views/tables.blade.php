@extends('layouts.app')

@section('style')
<style>
  .guest {
    vertical-align: top;
  }
  .table {
      display: inline-block;
      width: 350px;
      height: 350px;
      border: solid 1px black;
      vertical-align: top;
  }
  .table .name {
    text-align: center;
  }
  .table.round {
      border-radius: 30px;
  }
  .table.over-capacity {
    border-color: red;
  }
  .table.full-capacity {
    border-color: green;
    border-width: 3px;
  }
</style>
@endsection

@section('content')
  <div id="assignment">
    @foreach($invitations as $invitation)
      <div class="invitation draggable drag-drop" data-id="{{$invitation->id}}" style="margin: 10px; padding: 10px; border: solid 1px black; display: inline-block;">
        @foreach($invitation->guests as $guest)
          <div class="guest" data-id="{{$guest->id}}">{{$guest->first_name}} {{$guest->last_name}}</div>
        @endforeach
      </div>
    @endforeach
    <br />
    <hr />
    <br />
    @foreach($tables as $table)
       <div class="table {{$table->type}} {{$table->getCssClass()}}" data-id="{{$table->id}}">
           <div class="name">{{$table->name}} ({{$table->getTotalGuests()}}/{{$table->getCapacity()}} guests)</div>
           <div class="seats">
            @foreach($table->invitations as $invitation)
              <div class="invitation draggable drag-drop" data-id="{{$invitation->id}}" style="margin: 10px; padding: 10px; border: solid 1px black; display: inline-block;">
              @foreach($invitation->guests as $guest)
                <div class="guest" data-id="{{$guest->id}}">{{$guest->first_name}} {{$guest->last_name}}</div>
              @endforeach
              </div>
            @endforeach
           </div>
       </div>
    @endforeach
  </div>
@endsection

@section('vendor-script')
<script src="{{ asset('js/interact.js') }}"></script>
@endsection

@section('body-script')
<script>
function dragMoveListener (event) {
  var target = event.target,
    // keep the dragged position in the data-x/data-y attributes
    x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx,
    y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

  // translate the element
  target.style.webkitTransform = target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';

  // update the posiion attributes
  target.setAttribute('data-x', x);
  target.setAttribute('data-y', y);
}

interact('.invitation').draggable(
    {
        inertia: false,
    // keep the element within the area of it's parent
    
    // enable autoScroll
    autoScroll: true,

    // call this function on every dragmove event
    onmove: dragMoveListener,
    onend: () => {}
    }
)
interact('.table').dropzone({
    // only accept elements matching this CSS selector
  accept: '.invitation',
  // Require a 75% element overlap for a drop to be possible
  overlap: 0.75,

  // listen for drop related events:

  ondropactivate: function (event) {
    // add active dropzone feedback
  },
  ondragenter: function (event) {
    var draggableElement = event.relatedTarget,
        dropzoneElement = event.target;
    
    // feedback the possibility of a drop
  },
  ondragleave: function (event) {
    // remove the drop feedback style
    
  },
  ondrop: function (event) {
      var tableId = $(event.target).data('id')
      var invitationId = $(event.relatedTarget).data('id')
      
      fetch(`/api/assign?table=${tableId}&invitation=${invitationId}`, {
          method: 'post',
          credentials: 'include'
      })
      .then((res) => res.json() )
      .then((data) => {
          console.log(data)
      })
      .catch((err) => {
          console.log(err.message)
      })
  },
  ondropdeactivate: function (event) {
    // remove active dropzone feedback
  }
})



</script>
@endsection