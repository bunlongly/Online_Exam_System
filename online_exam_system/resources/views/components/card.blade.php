<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
    }

    .container {
        background-color: #ffffff;
        padding: 20px 40px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: auto;
    }

    .container h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .container a {
        text-decoration: none;
        color: #007bff;
    }

    .btn {
        cursor: pointer;
        display: inline-block;
        width: 100%;
        background: #007bff;
        padding: 15px;
        font-family: inherit;
        font-size: 16px;
        color: #fff;
        border: 0;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .btn:focus {
        outline: 0;
    }

    .btn:active {
        transform: scale(0.98);
    }

    .form-control {
        position: relative;
        margin-bottom: 20px;
    }

    .form-control input,
    .form-control select {
        background-color: transparent;
        border: 0;
        border-bottom: 2px solid #ddd;
        display: block;
        width: 100%;
        padding: 10px 0;
        font-size: 16px;
        color: #333;
        transition: border-color 0.3s;
    }

    .form-control input:focus,
    .form-control input:valid,
    .form-control select:focus {
        outline: 0;
        border-bottom-color: #007bff;
    }

    .form-control label {
        position: absolute;
        top: 10px;
        left: 0;
        pointer-events: none;
        transition: top 0.3s, font-size 0.3s;
    }

    .form-control input:focus + label,
    .form-control input:valid + label {
        top: -10px;
        font-size: 12px;
        color: #007bff;
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        .form-control {
            width: 100%;
        }
    }
</style>

<div class="border border-gray-200 rounded p-6 {{ $attributes['class'] }}">
    {{$slot}}
</div>
