@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.room.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.rooms.update", [$room->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="hostel_id">{{ trans('cruds.room.fields.hostel') }}</label>
                            <select class="form-control select2" name="hostel_id" id="hostel_id" required>
                                @foreach($hostels as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('hostel_id') ? old('hostel_id') : $room->hostel->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('hostel'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hostel') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.room.fields.hostel_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="room_info">{{ trans('cruds.room.fields.room_info') }}</label>
                            <input class="form-control" type="text" name="room_info" id="room_info" value="{{ old('room_info', $room->room_info) }}" required>
                            @if($errors->has('room_info'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('room_info') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.room.fields.room_info_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="facilities">{{ trans('cruds.room.fields.facilities') }}</label>
                            <textarea class="form-control ckeditor" name="facilities" id="facilities">{!! old('facilities', $room->facilities) !!}</textarea>
                            @if($errors->has('facilities'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('facilities') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.room.fields.facilities_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="images">{{ trans('cruds.room.fields.images') }}</label>
                            <div class="needsclick dropzone" id="images-dropzone">
                            </div>
                            @if($errors->has('images'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('images') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.room.fields.images_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="price">{{ trans('cruds.room.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', $room->price) }}" step="0.01">
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.room.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
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
                xhr.open('POST', '{{ route('frontend.rooms.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $room->id ?? 0 }}');
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

<script>
    var uploadedImagesMap = {}
Dropzone.options.imagesDropzone = {
    url: '{{ route('frontend.rooms.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
      uploadedImagesMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImagesMap[file.name]
      }
      $('form').find('input[name="images[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($room) && $room->images)
      var files = {!! json_encode($room->images) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
@endsection