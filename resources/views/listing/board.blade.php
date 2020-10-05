@extends('layouts.app')
@section('style')
 <style type="text/css">
    *, *::before, *::after {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    body {
        font-family: Arial, sans-serif;
        font-size: 16px;
        line-height: normal;
        font-weight: 400;
    }

    .hero {
        width: 100%;
        min-height: 100vh;
    }

    .wrapper {
        max-width: 1024px;
        margin: 0 auto;
    }

    .list {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 100px 0;
    }

    .list__cell {
        flex-basis: calc(25% - 40px);
        min-height: 150px;
        margin: 20px;
        list-style: none;
        box-shadow: 0px 0px 7px 5px rgba(0,0,0,0.2);
        overflow: hidden;
        background-color:#f0f2f5;;
    }

    .list__caption {
        width: calc(25% - 40px);
        margin: 0 20px;
        list-style: none;
        font-weight: bold;
        color: #0747a6;
    }

    .list__card {
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
        text-align: center;
        min-height: 100%;
        cursor: all-scroll;
    }

    .list__card-header {
        text-transform: lowercase;
        font-weight: bold;
        padding: 12px 20px;
        background-color: #0747a6;
        color: white;
    }

    .list__card-info {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #eff5ff;
        flex-grow: 1;
        padding: 12px 20px;
        font-size: 14px;
        text-transform: uppercase;
        font-weight: 600;
    }

    .hovered {
        background-color: #d1d8e2;
    }

    .hide {
        display: none;
    }
 </style>
@endsection

@section('content')

<div class="hero">
    <div class="wrapper">
        <ul class="list">
            <li class="list__caption">Planned</li>
            <li class="list__caption">In dev</li>
            <li class="list__caption">QA</li>
            <li class="list__caption">Production</li>
            <li class="list__cell js-cell">
                <div class="list__card js-card" draggable="true">
                    <div class="list__card-header">
                        task title
                    </div>
                    <div class="list__card-info">
                        Task description
                    </div>
                </div>
            </li>
            <li class="list__cell js-cell">

            </li>
            <li class="list__cell js-cell">

            </li>
            <li class="list__cell js-cell">

            </li>
        </ul>
    </div>
</div>

@endsection

@section('script')
<script src=" http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js "></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>

 <script type="text/javascript">
    const dragAndDrop = () => {
        const card = document.querySelector('.js-card');
        const cells = document.querySelectorAll('.js-cell');

        const dragStart = function () {
            setTimeout(() => {
                this.classList.add('hide');
            }, 0);
        };

        const dragEnd = function () {
            this.classList.remove('hide');
        };

        const dragOver = function (evt) {
            evt.preventDefault();
        };

        const dragEnter = function (evt) {
            evt.preventDefault();
            this.classList.add('hovered');
        };

        const dragLeave = function () {
            this.classList.remove('hovered');
        };

        const dragDrop = function () {
            this.append(card);
            this.classList.remove('hovered');
        };

        cells.forEach(cell => {
            cell.addEventListener('dragover', dragOver);
            cell.addEventListener('dragenter', dragEnter);
            cell.addEventListener('dragleave', dragLeave);
            cell.addEventListener('drop', dragDrop);
        });


        card.addEventListener('dragstart', dragStart);
        card.addEventListener('dragend', dragEnd);
    };

    dragAndDrop();
</script>
@endsection




