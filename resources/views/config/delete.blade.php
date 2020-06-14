@extends('layouts.app')

@section('content')
<div class="container">   
    <div class="row">
        <div class="col-sm-12 col-xs-6 config_param config_param-flex_wrap config_param-jc-center">
            <span class="col-sm-12 delete_description">Будут удалены все записи, созданные или обновленные позднее выбранной даты</span>
            <select name="time">
                <option value="today">Сегодня</option>
                <option value="yesterday">Вчера</option>
                <option value="2daysago">2 дня назад</option>
                <option value="week">Неделю назад</option>
                <option value="2week">2 недели назад</option>
                <option value="month">Месяц назад</option>
                <option value="all">За все время</option>
            </select>
            {{-- <label for="apikey" class="col-sm-6 control-label"> Параметры удаления</label> --}}
            {{-- <input class="config_input" name="apikey" type="text" v-model="apikey" placeholder="Укажите промежуток для удаления" @change="apiKeyUpdate" > --}}
        </div>
    </div>
</div>
@endsection