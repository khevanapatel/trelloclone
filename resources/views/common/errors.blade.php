@if(count($errors)> 0)
    <!--Form Error List -->
    <div class="alert alert-danger">
        <div><strong>Please correct the characters you typed</strong></div>
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif