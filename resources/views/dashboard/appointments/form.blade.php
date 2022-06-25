<div class="form-group">
    {!! Form::label('inputUser', 'User') !!}
    {!! Form::select('user_id', $users, null, ['id' => 'inputUser', 'class' => 'form-control', 'placeholder' => 'Select User...']) !!}
    @error('user_id')
        <span>
            <small class="text-danger">{{ $message }}</small>
        </span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('inputAppointment', 'appointment') !!}
    {!! Form::date('appointment', old('appointment'), ['id' => 'inputAppointment', 'class' => 'form-control']) !!}
    @error('appointment')
        <span>
            <small class="text-danger">{{ $message }}</small>
        </span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('inputReason', 'Reason') !!}
    {!! Form::textarea('reason', old('reason'), ['id' => 'inputReason', 'class' => 'form-control', 'placeholder' => 'Enter the reason' ]) !!}
    @error('reason')
        <span>
            <small class="text-danger">{{ $message }}</small>
        </span>
    @enderror
</div>



{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
