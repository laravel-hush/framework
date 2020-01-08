@extends ('hush::components.layouts.app')

@section ('content')
<div class="block">
    <div class="headline">
        <span class="h1">Block title</span>
        <div class="buttons">
            <a href="#" class="btn btn-light">
                <i class="material-icons">add</i>
                <span>Add</span>
            </a>
            <a href="#" class="btn btn-light d-flex" data-toggle="modal" data-target="#exampleModal">
                <i class="material-icons">filter_list</i>
                <span>Filter</span>
            </a>
            <a href="#" class="btn btn-primary d-flex">
                <i class="material-icons">save</i>
                <span>Save</span>
            </a>
        </div>
    </div>

    <div class="table table-striped table-borderless">
        <div class="row head">
            <div class="col id">#</div>
            <div class="col">First</div>
            <div class="col">Handle</div>
            <div class="col">Last</div>
            <div class="col actions">Actions</div>
        </div>
        @for ($i = 0; $i < 10; $i++)
        <div class="row">
            <div class="col id">1</div>
            <div class="col">Mark</div>
            <div class="col">Otto</div>
            <div class="col">@mdo</div>
            <div class="col actions">
                <a href="#" class="btn btn-additional btn-rounded">
                    <i class="material-icons">remove_red_eye</i>
                    <span>Show</span>
                </a>
                <a href="#" class="btn btn-primary btn-round">
                    <i class="material-icons">edit</i>
                </a>
                <a href="#" class="btn btn-danger btn-round delete-item">
                    <i class="material-icons">delete</i>
                </a>
            </div>
        </div>
        @endfor
    </div>

    <label class="checkbox">
        <input type="checkbox" name="name" class="form-control d-none" value="1">
    
        <div class="replacer">
            <i class="material-icons">done</i>
        </div>
        <span class="text">Some checkbox</span>
    </label>

    <label class="radio">
        <input type="radio" name="name" class="form-control d-none" value="1">
    
        <div class="replacer">
            <i class="material-icons">fiber_manual_record</i>
        </div>
        <span class="text">Some radiobutton</span>
    </label>
    <label class="radio">
        <input type="radio" name="name" class="form-control d-none" value="1">
    
        <div class="replacer">
            <i class="material-icons">fiber_manual_record</i>
        </div>
        <span class="text">Some radiobutton</span>
    </label>

    <div class="form-group">
        <label>Label:</label>
        <input type="text" class="form-control" placeholder="Enter some text...">
    </div>
    <div class="form-group">
        <label>Label:</label>
        <input type="text" class="form-control" placeholder="Enter some text..." disabled>
    </div>
    <div class="form-group error">
        <label>Label:</label>
        <input type="number" class="form-control" placeholder="Enter some text...">
        <small>Some kind of error here</small>
    </div>
    <div class="form-group">
        <label>Label:</label>
        <select class="form-control">
            @for ($i = 0; $i < 20; $i++)
            <option value="0">Option</option>
            @endfor
        </select>
    </div>
    <div class="form-group">
        <label>Label:</label>
        <select class="form-control" multiple>
            @for ($i = 0; $i < 80; $i++)
            <option value="0" {{ $i % 3 == 0 ? 'selected' : '' }}>Option</option>
            @endfor
        </select>
    </div>
    <div class="form-group">
        <label>WYSIWYG:</label>
        <textarea name="wysiwyg" class="wysiwyg"></textarea>
    </div>
    <div class="form-group">
        <label>CodeMirror:</label>
        <textarea name="codemirror" class="codemirror">Some random <textarea name="" id="" cols="30" rows="10"></textarea></textarea>
    </div>
    <div class="form-group">
        <label>Label:</label>
        <textarea class="form-control" placeholder="Placeholder"></textarea>
    </div>
    <div class="form-group">
        <label>Label:</label>
        <textarea class="form-control" placeholder="Placeholder"></textarea>
    </div>
    <div class="form-group">
        <label>Label:</label>
        <textarea class="form-control" placeholder="Placeholder"></textarea>
    </div>
    <div class="form-group">
        <label>Label:</label>
        <textarea class="form-control" placeholder="Placeholder"></textarea>
    </div>
    <div class="form-group">
        <label>Label:</label>
        <textarea class="form-control" placeholder="Placeholder"></textarea>
    </div>
    <div class="form-group">
        <label>Label:</label>
        <textarea class="form-control" placeholder="Placeholder"></textarea>
    </div>
    <div class="form-group">
        <label>Label:</label>
        <textarea class="form-control" placeholder="Placeholder"></textarea>
    </div>
    <div class="form-group">
        <label>Label:</label>
        <textarea class="form-control" placeholder="Placeholder"></textarea>
    </div>
    <div class="form-group">
        <label>Label:</label>
        <textarea class="form-control" placeholder="Placeholder"></textarea>
    </div>
    <div class="form-group">
        <label>Label:</label>
        <textarea class="form-control" placeholder="Placeholder"></textarea>
    </div>
    <div class="form-group">
        <label>Label:</label>
        <textarea class="form-control" placeholder="Placeholder"></textarea>
    </div>
    <div class="form-group">
        <label>Label:</label>
        <textarea class="form-control" placeholder="Placeholder"></textarea>
    </div>
    <div class="form-group">
        <label>Label:</label>
        <textarea class="form-control" placeholder="Placeholder"></textarea>
    </div>
    <div class="form-group">
        <label>Label:</label>
        <textarea class="form-control" placeholder="Placeholder"></textarea>
    </div>
</div>

<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content swal2-show">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Label:</label>
                    <input type="text" class="form-control" placeholder="Enter some text...">
                </div>
                <div class="form-group">
                    <label>Label:</label>
                    <input type="text" class="form-control" placeholder="Enter some text..." disabled>
                </div>
                <div class="form-group error">
                    <label>Label:</label>
                    <input type="number" class="form-control" placeholder="Enter some text...">
                    <small>Some kind of error here</small>
                </div>
                <div class="form-group">
                    <label>Label:</label>
                    <select class="form-control">
                        <option value="0">Option</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Label:</label>
                    <textarea class="form-control" placeholder="Placeholder"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection