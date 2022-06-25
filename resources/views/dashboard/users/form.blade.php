<div class="form-group">
    {!! Form::label('inputImage', 'Image') !!}
    {!! Form::file('image', ['id' => 'inputName', 'class' => 'form-control']) !!}
    @error('image')
        <span>
            <small class="text-danger">{{ $message }}</small>
        </span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('inputName', 'Name') !!}
    {!! Form::text('name', old('name'), ['id' => 'inputName', 'class' => 'form-control', 'placeholder' => 'Enter name' ]) !!}
    @error('name')
        <span>
            <small class="text-danger">{{ $message }}</small>
        </span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('inputPhone', 'Phone') !!}
    {!! Form::text('phone', old('phone'), ['id' => 'inputPhone', 'class' => 'form-control', 'placeholder' => 'Enter phone number' ]) !!}
    @error('phone')
        <span>
            <small class="text-danger">{{ $message }}</small>
        </span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('inputEmail', 'Email-Address') !!}
    {!! Form::email('email', old('email'), ['id' => 'inputEmail', 'class' => 'form-control', 'placeholder' => 'Enter Email' ]) !!}
    @error('email')
        <span>
            <small class="text-danger">{{ $message }}</small>
        </span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('inputPassword', 'Password') !!}
    {!! Form::password('password', ['id' => 'inputPassword', 'class' => 'form-control', 'placeholder' => 'Enter Password' ]) !!}
    @error('password')
        <span>
            <small class="text-danger">{{ $message }}</small>
        </span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('inputConfirmPassword', 'Password Confirmation') !!}
    {!! Form::password('password_confirmation', ['id' => 'inputConfirmPassword', 'class' => 'form-control', 'placeholder' => 'Enter Confirmation Password' ]) !!}
    @error('password_confirmation')
        <span>
            <small class="text-danger">{{ $message }}</small>
        </span>
    @enderror
</div>

{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
