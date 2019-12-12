@extends('fifth_gui_generator::app')
@section('content')
    <h3>generate model</h3>
    <h5 class="mt-4">job description</h5>
    <form method="post" action="/fifth/model" class="mt-3">
        {{csrf_field()}}
    <div class="form-group">
        <label>name:</label>
        <input type="text" class="form-control col-lg-4" name="name">
{{--        <input type="checkbox">--}}
    </div>
    <div class="form-group">
        <input type="checkbox" name="withTimestamps">
        <label>with timestamps:</label>
    </div>
    <table class="table" id="modelTable">
        <thead>
            <tr>
                <th>name</th>
                <th>type</th>
                <th>length</th>
                <th>nullable</th>
                <th>default</th>
                <th>unique</th>
                <th>index</th>
                <th>fillable</th>
                <th>searchable</th>
                <th>filterable</th>
                <th>sortable</th>
                <th>validations</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr data-name="field">
                <th scope="row"><input type="text" class="input" name="fields[0][name]" value="id" required></th>
                <td>
                    <select name="fields[0][type]" placholder="type" value="bigIncrements">
                        <option>bigIncrements</option>
                        <option>increments</option>
                        <option>uuid</option>
                        <option>string</option>
                        <option>integer</option>
                        <option>text</option>
                    </select>
                </td>
                <td><input class="input" name="fields[0][length]" type="number"></td>
                <td><input name="fields[0][nullable]" type="checkbox"></td>
                <td><input name="fields[0][default]" type="text" class="input"></td>
                <td><input name="fields[0][unique]" type="checkbox"></td>
                <td><input name="fields[0][index]" type="checkbox"></td>
                <td><input name="fields[0][fillable]" type="checkbox"></td>
                <td><input name="fields[0][searchable]" type="checkbox"></td>
                <td><input name="fields[0][filterable]" type="checkbox"></td>
                <td><input name="fields[0][orderable]" type="checkbox"></td>
                <td><input class="input" name="fields[0][validations]" type="text"></td>
                <td><i class="fa fa-trash-o remove-icon" data-action="deleteRaw"></i></td>
            </tr>
        </tbody>
    </table>
        <button class="btn btn-primary float-right mt-5">generate</button>
    </form>
    <button class="btn btn-secondary" id="addField">add field</button>
    <ul class="mt-5">
        <li>add seed count property</li>
        <li>save model fields in database</li>
        <li>make ability to attach relations</li>
        <li>autofill validation</li>
        <li>add types</li>
        <li>make fields expandable(show name and type only)</li>
    </ul>
    @include('fifth_gui_generator::generator.script')
    @include('fifth_gui_generator::generator.style')
@endsection
