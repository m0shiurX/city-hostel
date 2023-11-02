@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.hostel.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.hostels.update", [$hostel->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.hostel.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $hostel->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hostel.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.hostel.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $hostel->phone) }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hostel.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.hostel.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $hostel->address) }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hostel.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="built_on">{{ trans('cruds.hostel.fields.built_on') }}</label>
                <input class="form-control {{ $errors->has('built_on') ? 'is-invalid' : '' }}" type="text" name="built_on" id="built_on" value="{{ old('built_on', $hostel->built_on) }}">
                @if($errors->has('built_on'))
                    <div class="invalid-feedback">
                        {{ $errors->first('built_on') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hostel.fields.built_on_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_seat">{{ trans('cruds.hostel.fields.total_seat') }}</label>
                <input class="form-control {{ $errors->has('total_seat') ? 'is-invalid' : '' }}" type="text" name="total_seat" id="total_seat" value="{{ old('total_seat', $hostel->total_seat) }}" required>
                @if($errors->has('total_seat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_seat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hostel.fields.total_seat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="garage">{{ trans('cruds.hostel.fields.garage') }}</label>
                <input class="form-control {{ $errors->has('garage') ? 'is-invalid' : '' }}" type="text" name="garage" id="garage" value="{{ old('garage', $hostel->garage) }}">
                @if($errors->has('garage'))
                    <div class="invalid-feedback">
                        {{ $errors->first('garage') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hostel.fields.garage_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="garage_size">{{ trans('cruds.hostel.fields.garage_size') }}</label>
                <input class="form-control {{ $errors->has('garage_size') ? 'is-invalid' : '' }}" type="text" name="garage_size" id="garage_size" value="{{ old('garage_size', $hostel->garage_size) }}">
                @if($errors->has('garage_size'))
                    <div class="invalid-feedback">
                        {{ $errors->first('garage_size') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hostel.fields.garage_size_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="aminities">{{ trans('cruds.hostel.fields.aminities') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('aminities') ? 'is-invalid' : '' }}" name="aminities" id="aminities">{!! old('aminities', $hostel->aminities) !!}</textarea>
                @if($errors->has('aminities'))
                    <div class="invalid-feedback">
                        {{ $errors->first('aminities') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hostel.fields.aminities_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.hostel.fields.note') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{!! old('note', $hostel->note) !!}</textarea>
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hostel.fields.note_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="facilities">{{ trans('cruds.hostel.fields.facility') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('facilities') ? 'is-invalid' : '' }}" name="facilities[]" id="facilities" multiple>
                    @foreach($facilities as $id => $facility)
                        <option value="{{ $id }}" {{ (in_array($id, old('facilities', [])) || $hostel->facilities->contains($id)) ? 'selected' : '' }}>{{ $facility }}</option>
                    @endforeach
                </select>
                @if($errors->has('facilities'))
                    <div class="invalid-feedback">
                        {{ $errors->first('facilities') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hostel.fields.facility_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.hostels.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $hostel->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection