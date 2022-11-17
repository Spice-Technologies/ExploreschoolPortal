<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}" type="text/css">

    <style>
        :root {
            --blue: #007bff;
            --indigo: #6610f2;
            --purple: #6f42c1;
            --pink: #e83e8c;
            --red: #dc3545;
            --orange: #fd7e14;
            --yellow: #ffc107;
            --green: #28a745;
            --teal: #20c997;
            --cyan: #17a2b8;
            --white: #fff;
            --gray: #6c757d;
            --gray-dark: #343a40;
            --primary: #007bff;
            --secondary: #6c757d;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
            --breakpoint-xs: 0;
            --breakpoint-sm: 576px;
            --breakpoint-md: 768px;
            --breakpoint-lg: 992px;
            --breakpoint-xl: 1200px;
            --font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box
        }

        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent
        }

        article,
        aside,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        main,
        nav,
        section {
            display: block
        }

        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff
        }

        [tabindex="-1"]:focus:not(:focus-visible) {
            outline: 0 !important
        }

        hr {
            box-sizing: content-box;
            height: 0;
            overflow: visible
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: .5rem
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        abbr[data-original-title],
        abbr[title] {
            text-decoration: underline;
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted;
            cursor: help;
            border-bottom: 0;
            -webkit-text-decoration-skip-ink: none;
            text-decoration-skip-ink: none
        }

        address {
            margin-bottom: 1rem;
            font-style: normal;
            line-height: inherit
        }

        dl,
        ol,
        ul {
            margin-top: 0;
            margin-bottom: 1rem
        }

        ol ol,
        ol ul,
        ul ol,
        ul ul {
            margin-bottom: 0
        }

        dt {
            font-weight: 700
        }

        dd {
            margin-bottom: .5rem;
            margin-left: 0
        }

        blockquote {
            margin: 0 0 1rem
        }

        b,
        strong {
            font-weight: bolder
        }

        small {
            font-size: 80%
        }

        sub,
        sup {
            position: relative;
            font-size: 75%;
            line-height: 0;
            vertical-align: baseline
        }

        sub {
            bottom: -.25em
        }

        sup {
            top: -.5em
        }

        a {
            color: #007bff;
            text-decoration: none;
            background-color: transparent
        }

        a:hover {
            color: #0056b3;
            text-decoration: underline
        }

        a:not([href]) {
            color: inherit;
            text-decoration: none
        }

        a:not([href]):hover {
            color: inherit;
            text-decoration: none
        }

        code,
        kbd,
        pre,
        samp {
            font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 1em
        }

        pre {
            margin-top: 0;
            margin-bottom: 1rem;
            overflow: auto
        }

        figure {
            margin: 0 0 1rem
        }

        img {
            vertical-align: middle;
            border-style: none
        }

        svg {
            overflow: hidden;
            vertical-align: middle
        }

        table {
            border-collapse: collapse
        }

        caption {
            padding-top: .75rem;
            padding-bottom: .75rem;
            color: #6c757d;
            text-align: left;
            caption-side: bottom
        }

        th {
            text-align: inherit
        }

        label {
            display: inline-block;
            margin-bottom: .5rem
        }

        button {
            border-radius: 0
        }

        button:focus {
            outline: 1px dotted;
            outline: 5px auto -webkit-focus-ring-color
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit
        }

        button,
        input {
            overflow: visible
        }

        button,
        select {
            text-transform: none
        }

        select {
            word-wrap: normal
        }

        [type=button],
        [type=reset],
        [type=submit],
        button {
            -webkit-appearance: button
        }

        [type=button]:not(:disabled),
        [type=reset]:not(:disabled),
        [type=submit]:not(:disabled),
        button:not(:disabled) {
            cursor: pointer
        }

        [type=button]::-moz-focus-inner,
        [type=reset]::-moz-focus-inner,
        [type=submit]::-moz-focus-inner,
        button::-moz-focus-inner {
            padding: 0;
            border-style: none
        }

        input[type=checkbox],
        input[type=radio] {
            box-sizing: border-box;
            padding: 0
        }

        input[type=date],
        input[type=datetime-local],
        input[type=month],
        input[type=time] {
            -webkit-appearance: listbox
        }

        textarea {
            overflow: auto;
            resize: vertical
        }

        fieldset {
            min-width: 0;
            padding: 0;
            margin: 0;
            border: 0
        }

        legend {
            display: block;
            width: 100%;
            max-width: 100%;
            padding: 0;
            margin-bottom: .5rem;
            font-size: 1.5rem;
            line-height: inherit;
            color: inherit;
            white-space: normal
        }

        progress {
            vertical-align: baseline
        }

        [type=number]::-webkit-inner-spin-button,
        [type=number]::-webkit-outer-spin-button {
            height: auto
        }

        [type=search] {
            outline-offset: -2px;
            -webkit-appearance: none
        }

        [type=search]::-webkit-search-decoration {
            -webkit-appearance: none
        }

        ::-webkit-file-upload-button {
            font: inherit;
            -webkit-appearance: button
        }

        output {
            display: inline-block
        }

        summary {
            display: list-item;
            cursor: pointer
        }

        template {
            display: none
        }

        [hidden] {
            display: none !important
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-bottom: .5rem;
            font-weight: 500;
            line-height: 1.2
        }

        .h1,
        h1 {
            font-size: 2.5rem
        }

        .h2,
        h2 {
            font-size: 2rem
        }

        .h3,
        h3 {
            font-size: 1.75rem
        }

        .h4,
        h4 {
            font-size: 1.5rem
        }

        .h5,
        h5 {
            font-size: 1.25rem
        }

        .h6,
        h6 {
            font-size: 1rem
        }

        .lead {
            font-size: 1.25rem;
            font-weight: 300
        }

        .display-1 {
            font-size: 6rem;
            font-weight: 300;
            line-height: 1.2
        }

        .display-2 {
            font-size: 5.5rem;
            font-weight: 300;
            line-height: 1.2
        }

        .display-3 {
            font-size: 4.5rem;
            font-weight: 300;
            line-height: 1.2
        }

        .display-4 {
            font-size: 3.5rem;
            font-weight: 300;
            line-height: 1.2
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1)
        }

        .small,
        small {
            font-size: 80%;
            font-weight: 400
        }

        .mark,
        mark {
            padding: .2em;
            background-color: #fcf8e3
        }

        .list-unstyled {
            padding-left: 0;
            list-style: none
        }

        .list-inline {
            padding-left: 0;
            list-style: none
        }

        .list-inline-item {
            display: inline-block
        }

        .list-inline-item:not(:last-child) {
            margin-right: .5rem
        }

        .initialism {
            font-size: 90%;
            text-transform: uppercase
        }

        .blockquote {
            margin-bottom: 1rem;
            font-size: 1.25rem
        }

        .blockquote-footer {
            display: block;
            font-size: 80%;
            color: #6c757d
        }

        .blockquote-footer::before {
            content: "\2014\00A0"
        }

        .img-fluid {
            max-width: 100%;
            height: auto
        }

        .img-thumbnail {
            padding: .25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: .25rem;
            max-width: 100%;
            height: auto
        }

        .figure {
            display: inline-block
        }

        .figure-img {
            margin-bottom: .5rem;
            line-height: 1
        }

        .figure-caption {
            font-size: 90%;
            color: #6c757d
        }

        code {
            font-size: 87.5%;
            color: #e83e8c;
            word-wrap: break-word
        }

        a>code {
            color: inherit
        }

        kbd {
            padding: .2rem .4rem;
            font-size: 87.5%;
            color: #fff;
            background-color: #212529;
            border-radius: .2rem
        }

        kbd kbd {
            padding: 0;
            font-size: 100%;
            font-weight: 700
        }

        pre {
            display: block;
            font-size: 87.5%;
            color: #212529
        }

        pre code {
            font-size: inherit;
            color: inherit;
            word-break: normal
        }

        .pre-scrollable {
            max-height: 340px;
            overflow-y: scroll
        }

        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto
        }

        @media (min-width:576px) {
            .container {
                max-width: 540px
            }
        }

        @media (min-width:768px) {
            .container {
                max-width: 720px
            }
        }

        @media (min-width:992px) {
            .container {
                max-width: 960px
            }
        }

        @media (min-width:1200px) {
            .container {
                max-width: 1140px
            }
        }

        .container-fluid,
        .container-lg,
        .container-md,
        .container-sm,
        .container-xl {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto
        }

        @media (min-width:576px) {

            .container,
            .container-sm {
                max-width: 540px
            }
        }

        @media (min-width:768px) {

            .container,
            .container-md,
            .container-sm {
                max-width: 720px
            }
        }

        @media (min-width:992px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm {
                max-width: 960px
            }
        }

        @media (min-width:1200px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl {
                max-width: 1140px
            }
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px
        }

        .no-gutters {
            margin-right: 0;
            margin-left: 0
        }

        .no-gutters>.col,
        .no-gutters>[class*=col-] {
            padding-right: 0;
            padding-left: 0
        }

        .col,
        .col-1,
        .col-10,
        .col-11,
        .col-12,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9,
        .col-auto,
        .col-lg,
        .col-lg-1,
        .col-lg-10,
        .col-lg-11,
        .col-lg-12,
        .col-lg-2,
        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-6,
        .col-lg-7,
        .col-lg-8,
        .col-lg-9,
        .col-lg-auto,
        .col-md,
        .col-md-1,
        .col-md-10,
        .col-md-11,
        .col-md-12,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-md-auto,
        .col-sm,
        .col-sm-1,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-auto,
        .col-xl,
        .col-xl-1,
        .col-xl-10,
        .col-xl-11,
        .col-xl-12,
        .col-xl-2,
        .col-xl-3,
        .col-xl-4,
        .col-xl-5,
        .col-xl-6,
        .col-xl-7,
        .col-xl-8,
        .col-xl-9,
        .col-xl-auto {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px
        }

        .col {
            -ms-flex-preferred-size: 0;
            flex-basis: 0;
            -ms-flex-positive: 1;
            flex-grow: 1;
            max-width: 100%
        }

        .row-cols-1>* {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%
        }

        .row-cols-2>* {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%
        }

        .row-cols-3>* {
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%
        }

        .row-cols-4>* {
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 25%
        }

        .row-cols-5>* {
            -ms-flex: 0 0 20%;
            flex: 0 0 20%;
            max-width: 20%
        }

        .row-cols-6>* {
            -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%;
            max-width: 16.666667%
        }

        .col-auto {
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: auto;
            max-width: 100%
        }

        .col-1 {
            -ms-flex: 0 0 8.333333%;
            flex: 0 0 8.333333%;
            max-width: 8.333333%
        }

        .col-2 {
            -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%;
            max-width: 16.666667%
        }

        .col-3 {
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 25%
        }

        .col-4 {
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%
        }

        .col-5 {
            -ms-flex: 0 0 41.666667%;
            flex: 0 0 41.666667%;
            max-width: 41.666667%
        }

        .col-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%
        }

        .col-7 {
            -ms-flex: 0 0 58.333333%;
            flex: 0 0 58.333333%;
            max-width: 58.333333%
        }

        .col-8 {
            -ms-flex: 0 0 66.666667%;
            flex: 0 0 66.666667%;
            max-width: 66.666667%
        }

        .col-9 {
            -ms-flex: 0 0 75%;
            flex: 0 0 75%;
            max-width: 75%
        }

        .col-10 {
            -ms-flex: 0 0 83.333333%;
            flex: 0 0 83.333333%;
            max-width: 83.333333%
        }

        .col-11 {
            -ms-flex: 0 0 91.666667%;
            flex: 0 0 91.666667%;
            max-width: 91.666667%
        }

        .col-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%
        }

        .order-first {
            -ms-flex-order: -1;
            order: -1
        }

        .order-last {
            -ms-flex-order: 13;
            order: 13
        }

        .order-0 {
            -ms-flex-order: 0;
            order: 0
        }

        .order-1 {
            -ms-flex-order: 1;
            order: 1
        }

        .order-2 {
            -ms-flex-order: 2;
            order: 2
        }

        .order-3 {
            -ms-flex-order: 3;
            order: 3
        }

        .order-4 {
            -ms-flex-order: 4;
            order: 4
        }

        .order-5 {
            -ms-flex-order: 5;
            order: 5
        }

        .order-6 {
            -ms-flex-order: 6;
            order: 6
        }

        .order-7 {
            -ms-flex-order: 7;
            order: 7
        }

        .order-8 {
            -ms-flex-order: 8;
            order: 8
        }

        .order-9 {
            -ms-flex-order: 9;
            order: 9
        }

        .order-10 {
            -ms-flex-order: 10;
            order: 10
        }

        .order-11 {
            -ms-flex-order: 11;
            order: 11
        }

        .order-12 {
            -ms-flex-order: 12;
            order: 12
        }

        .offset-1 {
            margin-left: 8.333333%
        }

        .offset-2 {
            margin-left: 16.666667%
        }

        .offset-3 {
            margin-left: 25%
        }

        .offset-4 {
            margin-left: 33.333333%
        }

        .offset-5 {
            margin-left: 41.666667%
        }

        .offset-6 {
            margin-left: 50%
        }

        .offset-7 {
            margin-left: 58.333333%
        }

        .offset-8 {
            margin-left: 66.666667%
        }

        .offset-9 {
            margin-left: 75%
        }

        .offset-10 {
            margin-left: 83.333333%
        }

        .offset-11 {
            margin-left: 91.666667%
        }

        @media (min-width:576px) {
            .col-sm {
                -ms-flex-preferred-size: 0;
                flex-basis: 0;
                -ms-flex-positive: 1;
                flex-grow: 1;
                max-width: 100%
            }

            .row-cols-sm-1>* {
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%
            }

            .row-cols-sm-2>* {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%
            }

            .row-cols-sm-3>* {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%
            }

            .row-cols-sm-4>* {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%
            }

            .row-cols-sm-5>* {
                -ms-flex: 0 0 20%;
                flex: 0 0 20%;
                max-width: 20%
            }

            .row-cols-sm-6>* {
                -ms-flex: 0 0 16.666667%;
                flex: 0 0 16.666667%;
                max-width: 16.666667%
            }

            .col-sm-auto {
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: auto;
                max-width: 100%
            }

            .col-sm-1 {
                -ms-flex: 0 0 8.333333%;
                flex: 0 0 8.333333%;
                max-width: 8.333333%
            }

            .col-sm-2 {
                -ms-flex: 0 0 16.666667%;
                flex: 0 0 16.666667%;
                max-width: 16.666667%
            }

            .col-sm-3 {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%
            }

            .col-sm-4 {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%
            }

            .col-sm-5 {
                -ms-flex: 0 0 41.666667%;
                flex: 0 0 41.666667%;
                max-width: 41.666667%
            }

            .col-sm-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%
            }

            .col-sm-7 {
                -ms-flex: 0 0 58.333333%;
                flex: 0 0 58.333333%;
                max-width: 58.333333%
            }

            .col-sm-8 {
                -ms-flex: 0 0 66.666667%;
                flex: 0 0 66.666667%;
                max-width: 66.666667%
            }

            .col-sm-9 {
                -ms-flex: 0 0 75%;
                flex: 0 0 75%;
                max-width: 75%
            }

            .col-sm-10 {
                -ms-flex: 0 0 83.333333%;
                flex: 0 0 83.333333%;
                max-width: 83.333333%
            }

            .col-sm-11 {
                -ms-flex: 0 0 91.666667%;
                flex: 0 0 91.666667%;
                max-width: 91.666667%
            }

            .col-sm-12 {
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%
            }

            .order-sm-first {
                -ms-flex-order: -1;
                order: -1
            }

            .order-sm-last {
                -ms-flex-order: 13;
                order: 13
            }

            .order-sm-0 {
                -ms-flex-order: 0;
                order: 0
            }

            .order-sm-1 {
                -ms-flex-order: 1;
                order: 1
            }

            .order-sm-2 {
                -ms-flex-order: 2;
                order: 2
            }

            .order-sm-3 {
                -ms-flex-order: 3;
                order: 3
            }

            .order-sm-4 {
                -ms-flex-order: 4;
                order: 4
            }

            .order-sm-5 {
                -ms-flex-order: 5;
                order: 5
            }

            .order-sm-6 {
                -ms-flex-order: 6;
                order: 6
            }

            .order-sm-7 {
                -ms-flex-order: 7;
                order: 7
            }

            .order-sm-8 {
                -ms-flex-order: 8;
                order: 8
            }

            .order-sm-9 {
                -ms-flex-order: 9;
                order: 9
            }

            .order-sm-10 {
                -ms-flex-order: 10;
                order: 10
            }

            .order-sm-11 {
                -ms-flex-order: 11;
                order: 11
            }

            .order-sm-12 {
                -ms-flex-order: 12;
                order: 12
            }

            .offset-sm-0 {
                margin-left: 0
            }

            .offset-sm-1 {
                margin-left: 8.333333%
            }

            .offset-sm-2 {
                margin-left: 16.666667%
            }

            .offset-sm-3 {
                margin-left: 25%
            }

            .offset-sm-4 {
                margin-left: 33.333333%
            }

            .offset-sm-5 {
                margin-left: 41.666667%
            }

            .offset-sm-6 {
                margin-left: 50%
            }

            .offset-sm-7 {
                margin-left: 58.333333%
            }

            .offset-sm-8 {
                margin-left: 66.666667%
            }

            .offset-sm-9 {
                margin-left: 75%
            }

            .offset-sm-10 {
                margin-left: 83.333333%
            }

            .offset-sm-11 {
                margin-left: 91.666667%
            }
        }

        @media (min-width:768px) {
            .col-md {
                -ms-flex-preferred-size: 0;
                flex-basis: 0;
                -ms-flex-positive: 1;
                flex-grow: 1;
                max-width: 100%
            }

            .row-cols-md-1>* {
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%
            }

            .row-cols-md-2>* {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%
            }

            .row-cols-md-3>* {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%
            }

            .row-cols-md-4>* {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%
            }

            .row-cols-md-5>* {
                -ms-flex: 0 0 20%;
                flex: 0 0 20%;
                max-width: 20%
            }

            .row-cols-md-6>* {
                -ms-flex: 0 0 16.666667%;
                flex: 0 0 16.666667%;
                max-width: 16.666667%
            }

            .col-md-auto {
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: auto;
                max-width: 100%
            }

            .col-md-1 {
                -ms-flex: 0 0 8.333333%;
                flex: 0 0 8.333333%;
                max-width: 8.333333%
            }

            .col-md-2 {
                -ms-flex: 0 0 16.666667%;
                flex: 0 0 16.666667%;
                max-width: 16.666667%
            }

            .col-md-3 {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%
            }

            .col-md-4 {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%
            }

            .col-md-5 {
                -ms-flex: 0 0 41.666667%;
                flex: 0 0 41.666667%;
                max-width: 41.666667%
            }

            .col-md-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%
            }

            .col-md-7 {
                -ms-flex: 0 0 58.333333%;
                flex: 0 0 58.333333%;
                max-width: 58.333333%
            }

            .col-md-8 {
                -ms-flex: 0 0 66.666667%;
                flex: 0 0 66.666667%;
                max-width: 66.666667%
            }

            .col-md-9 {
                -ms-flex: 0 0 75%;
                flex: 0 0 75%;
                max-width: 75%
            }

            .col-md-10 {
                -ms-flex: 0 0 83.333333%;
                flex: 0 0 83.333333%;
                max-width: 83.333333%
            }

            .col-md-11 {
                -ms-flex: 0 0 91.666667%;
                flex: 0 0 91.666667%;
                max-width: 91.666667%
            }

            .col-md-12 {
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%
            }

            .order-md-first {
                -ms-flex-order: -1;
                order: -1
            }

            .order-md-last {
                -ms-flex-order: 13;
                order: 13
            }

            .order-md-0 {
                -ms-flex-order: 0;
                order: 0
            }

            .order-md-1 {
                -ms-flex-order: 1;
                order: 1
            }

            .order-md-2 {
                -ms-flex-order: 2;
                order: 2
            }

            .order-md-3 {
                -ms-flex-order: 3;
                order: 3
            }

            .order-md-4 {
                -ms-flex-order: 4;
                order: 4
            }

            .order-md-5 {
                -ms-flex-order: 5;
                order: 5
            }

            .order-md-6 {
                -ms-flex-order: 6;
                order: 6
            }

            .order-md-7 {
                -ms-flex-order: 7;
                order: 7
            }

            .order-md-8 {
                -ms-flex-order: 8;
                order: 8
            }

            .order-md-9 {
                -ms-flex-order: 9;
                order: 9
            }

            .order-md-10 {
                -ms-flex-order: 10;
                order: 10
            }

            .order-md-11 {
                -ms-flex-order: 11;
                order: 11
            }

            .order-md-12 {
                -ms-flex-order: 12;
                order: 12
            }

            .offset-md-0 {
                margin-left: 0
            }

            .offset-md-1 {
                margin-left: 8.333333%
            }

            .offset-md-2 {
                margin-left: 16.666667%
            }

            .offset-md-3 {
                margin-left: 25%
            }

            .offset-md-4 {
                margin-left: 33.333333%
            }

            .offset-md-5 {
                margin-left: 41.666667%
            }

            .offset-md-6 {
                margin-left: 50%
            }

            .offset-md-7 {
                margin-left: 58.333333%
            }

            .offset-md-8 {
                margin-left: 66.666667%
            }

            .offset-md-9 {
                margin-left: 75%
            }

            .offset-md-10 {
                margin-left: 83.333333%
            }

            .offset-md-11 {
                margin-left: 91.666667%
            }
        }

        @media (min-width:992px) {
            .col-lg {
                -ms-flex-preferred-size: 0;
                flex-basis: 0;
                -ms-flex-positive: 1;
                flex-grow: 1;
                max-width: 100%
            }

            .row-cols-lg-1>* {
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%
            }

            .row-cols-lg-2>* {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%
            }

            .row-cols-lg-3>* {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%
            }

            .row-cols-lg-4>* {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%
            }

            .row-cols-lg-5>* {
                -ms-flex: 0 0 20%;
                flex: 0 0 20%;
                max-width: 20%
            }

            .row-cols-lg-6>* {
                -ms-flex: 0 0 16.666667%;
                flex: 0 0 16.666667%;
                max-width: 16.666667%
            }

            .col-lg-auto {
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: auto;
                max-width: 100%
            }

            .col-lg-1 {
                -ms-flex: 0 0 8.333333%;
                flex: 0 0 8.333333%;
                max-width: 8.333333%
            }

            .col-lg-2 {
                -ms-flex: 0 0 16.666667%;
                flex: 0 0 16.666667%;
                max-width: 16.666667%
            }

            .col-lg-3 {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%
            }

            .col-lg-4 {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%
            }

            .col-lg-5 {
                -ms-flex: 0 0 41.666667%;
                flex: 0 0 41.666667%;
                max-width: 41.666667%
            }

            .col-lg-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%
            }

            .col-lg-7 {
                -ms-flex: 0 0 58.333333%;
                flex: 0 0 58.333333%;
                max-width: 58.333333%
            }

            .col-lg-8 {
                -ms-flex: 0 0 66.666667%;
                flex: 0 0 66.666667%;
                max-width: 66.666667%
            }

            .col-lg-9 {
                -ms-flex: 0 0 75%;
                flex: 0 0 75%;
                max-width: 75%
            }

            .col-lg-10 {
                -ms-flex: 0 0 83.333333%;
                flex: 0 0 83.333333%;
                max-width: 83.333333%
            }

            .col-lg-11 {
                -ms-flex: 0 0 91.666667%;
                flex: 0 0 91.666667%;
                max-width: 91.666667%
            }

            .col-lg-12 {
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%
            }

            .order-lg-first {
                -ms-flex-order: -1;
                order: -1
            }

            .order-lg-last {
                -ms-flex-order: 13;
                order: 13
            }

            .order-lg-0 {
                -ms-flex-order: 0;
                order: 0
            }

            .order-lg-1 {
                -ms-flex-order: 1;
                order: 1
            }

            .order-lg-2 {
                -ms-flex-order: 2;
                order: 2
            }

            .order-lg-3 {
                -ms-flex-order: 3;
                order: 3
            }

            .order-lg-4 {
                -ms-flex-order: 4;
                order: 4
            }

            .order-lg-5 {
                -ms-flex-order: 5;
                order: 5
            }

            .order-lg-6 {
                -ms-flex-order: 6;
                order: 6
            }

            .order-lg-7 {
                -ms-flex-order: 7;
                order: 7
            }

            .order-lg-8 {
                -ms-flex-order: 8;
                order: 8
            }

            .order-lg-9 {
                -ms-flex-order: 9;
                order: 9
            }

            .order-lg-10 {
                -ms-flex-order: 10;
                order: 10
            }

            .order-lg-11 {
                -ms-flex-order: 11;
                order: 11
            }

            .order-lg-12 {
                -ms-flex-order: 12;
                order: 12
            }

            .offset-lg-0 {
                margin-left: 0
            }

            .offset-lg-1 {
                margin-left: 8.333333%
            }

            .offset-lg-2 {
                margin-left: 16.666667%
            }

            .offset-lg-3 {
                margin-left: 25%
            }

            .offset-lg-4 {
                margin-left: 33.333333%
            }

            .offset-lg-5 {
                margin-left: 41.666667%
            }

            .offset-lg-6 {
                margin-left: 50%
            }

            .offset-lg-7 {
                margin-left: 58.333333%
            }

            .offset-lg-8 {
                margin-left: 66.666667%
            }

            .offset-lg-9 {
                margin-left: 75%
            }

            .offset-lg-10 {
                margin-left: 83.333333%
            }

            .offset-lg-11 {
                margin-left: 91.666667%
            }
        }

        @media (min-width:1200px) {
            .col-xl {
                -ms-flex-preferred-size: 0;
                flex-basis: 0;
                -ms-flex-positive: 1;
                flex-grow: 1;
                max-width: 100%
            }

            .row-cols-xl-1>* {
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%
            }

            .row-cols-xl-2>* {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%
            }

            .row-cols-xl-3>* {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%
            }

            .row-cols-xl-4>* {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%
            }

            .row-cols-xl-5>* {
                -ms-flex: 0 0 20%;
                flex: 0 0 20%;
                max-width: 20%
            }

            .row-cols-xl-6>* {
                -ms-flex: 0 0 16.666667%;
                flex: 0 0 16.666667%;
                max-width: 16.666667%
            }

            .col-xl-auto {
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: auto;
                max-width: 100%
            }

            .col-xl-1 {
                -ms-flex: 0 0 8.333333%;
                flex: 0 0 8.333333%;
                max-width: 8.333333%
            }

            .col-xl-2 {
                -ms-flex: 0 0 16.666667%;
                flex: 0 0 16.666667%;
                max-width: 16.666667%
            }

            .col-xl-3 {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%
            }

            .col-xl-4 {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%
            }

            .col-xl-5 {
                -ms-flex: 0 0 41.666667%;
                flex: 0 0 41.666667%;
                max-width: 41.666667%
            }

            .col-xl-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%
            }

            .col-xl-7 {
                -ms-flex: 0 0 58.333333%;
                flex: 0 0 58.333333%;
                max-width: 58.333333%
            }

            .col-xl-8 {
                -ms-flex: 0 0 66.666667%;
                flex: 0 0 66.666667%;
                max-width: 66.666667%
            }

            .col-xl-9 {
                -ms-flex: 0 0 75%;
                flex: 0 0 75%;
                max-width: 75%
            }

            .col-xl-10 {
                -ms-flex: 0 0 83.333333%;
                flex: 0 0 83.333333%;
                max-width: 83.333333%
            }

            .col-xl-11 {
                -ms-flex: 0 0 91.666667%;
                flex: 0 0 91.666667%;
                max-width: 91.666667%
            }

            .col-xl-12 {
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%
            }

            .order-xl-first {
                -ms-flex-order: -1;
                order: -1
            }

            .order-xl-last {
                -ms-flex-order: 13;
                order: 13
            }

            .order-xl-0 {
                -ms-flex-order: 0;
                order: 0
            }

            .order-xl-1 {
                -ms-flex-order: 1;
                order: 1
            }

            .order-xl-2 {
                -ms-flex-order: 2;
                order: 2
            }

            .order-xl-3 {
                -ms-flex-order: 3;
                order: 3
            }

            .order-xl-4 {
                -ms-flex-order: 4;
                order: 4
            }

            .order-xl-5 {
                -ms-flex-order: 5;
                order: 5
            }

            .order-xl-6 {
                -ms-flex-order: 6;
                order: 6
            }

            .order-xl-7 {
                -ms-flex-order: 7;
                order: 7
            }

            .order-xl-8 {
                -ms-flex-order: 8;
                order: 8
            }

            .order-xl-9 {
                -ms-flex-order: 9;
                order: 9
            }

            .order-xl-10 {
                -ms-flex-order: 10;
                order: 10
            }

            .order-xl-11 {
                -ms-flex-order: 11;
                order: 11
            }

            .order-xl-12 {
                -ms-flex-order: 12;
                order: 12
            }

            .offset-xl-0 {
                margin-left: 0
            }

            .offset-xl-1 {
                margin-left: 8.333333%
            }

            .offset-xl-2 {
                margin-left: 16.666667%
            }

            .offset-xl-3 {
                margin-left: 25%
            }

            .offset-xl-4 {
                margin-left: 33.333333%
            }

            .offset-xl-5 {
                margin-left: 41.666667%
            }

            .offset-xl-6 {
                margin-left: 50%
            }

            .offset-xl-7 {
                margin-left: 58.333333%
            }

            .offset-xl-8 {
                margin-left: 66.666667%
            }

            .offset-xl-9 {
                margin-left: 75%
            }

            .offset-xl-10 {
                margin-left: 83.333333%
            }

            .offset-xl-11 {
                margin-left: 91.666667%
            }
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6
        }

        .table-sm td,
        .table-sm th {
            padding: .3rem
        }

        .table-bordered {
            border: 1px solid #dee2e6
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6
        }

        .table-bordered thead td,
        .table-bordered thead th {
            border-bottom-width: 2px
        }

        .table-borderless tbody+tbody,
        .table-borderless td,
        .table-borderless th,
        .table-borderless thead th {
            border: 0
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, .05)
        }

        .table-hover tbody tr:hover {
            color: #212529;
            background-color: rgba(0, 0, 0, .075)
        }

        .table-primary,
        .table-primary>td,
        .table-primary>th {
            background-color: #b8daff
        }

        .table-primary tbody+tbody,
        .table-primary td,
        .table-primary th,
        .table-primary thead th {
            border-color: #7abaff
        }

        .table-hover .table-primary:hover {
            background-color: #9fcdff
        }

        .table-hover .table-primary:hover>td,
        .table-hover .table-primary:hover>th {
            background-color: #9fcdff
        }

        .table-secondary,
        .table-secondary>td,
        .table-secondary>th {
            background-color: #d6d8db
        }

        .table-secondary tbody+tbody,
        .table-secondary td,
        .table-secondary th,
        .table-secondary thead th {
            border-color: #b3b7bb
        }

        .table-hover .table-secondary:hover {
            background-color: #c8cbcf
        }

        .table-hover .table-secondary:hover>td,
        .table-hover .table-secondary:hover>th {
            background-color: #c8cbcf
        }

        .table-success,
        .table-success>td,
        .table-success>th {
            background-color: #c3e6cb
        }

        .table-success tbody+tbody,
        .table-success td,
        .table-success th,
        .table-success thead th {
            border-color: #8fd19e
        }

        .table-hover .table-success:hover {
            background-color: #b1dfbb
        }

        .table-hover .table-success:hover>td,
        .table-hover .table-success:hover>th {
            background-color: #b1dfbb
        }

        .table-info,
        .table-info>td,
        .table-info>th {
            background-color: #bee5eb
        }

        .table-info tbody+tbody,
        .table-info td,
        .table-info th,
        .table-info thead th {
            border-color: #86cfda
        }

        .table-hover .table-info:hover {
            background-color: #abdde5
        }

        .table-hover .table-info:hover>td,
        .table-hover .table-info:hover>th {
            background-color: #abdde5
        }

        .table-warning,
        .table-warning>td,
        .table-warning>th {
            background-color: #ffeeba
        }

        .table-warning tbody+tbody,
        .table-warning td,
        .table-warning th,
        .table-warning thead th {
            border-color: #ffdf7e
        }

        .table-hover .table-warning:hover {
            background-color: #ffe8a1
        }

        .table-hover .table-warning:hover>td,
        .table-hover .table-warning:hover>th {
            background-color: #ffe8a1
        }

        .table-danger,
        .table-danger>td,
        .table-danger>th {
            background-color: #f5c6cb
        }

        .table-danger tbody+tbody,
        .table-danger td,
        .table-danger th,
        .table-danger thead th {
            border-color: #ed969e
        }

        .table-hover .table-danger:hover {
            background-color: #f1b0b7
        }

        .table-hover .table-danger:hover>td,
        .table-hover .table-danger:hover>th {
            background-color: #f1b0b7
        }

        .table-light,
        .table-light>td,
        .table-light>th {
            background-color: #fdfdfe
        }

        .table-light tbody+tbody,
        .table-light td,
        .table-light th,
        .table-light thead th {
            border-color: #fbfcfc
        }

        .table-hover .table-light:hover {
            background-color: #ececf6
        }

        .table-hover .table-light:hover>td,
        .table-hover .table-light:hover>th {
            background-color: #ececf6
        }

        .table-dark,
        .table-dark>td,
        .table-dark>th {
            background-color: #c6c8ca
        }

        .table-dark tbody+tbody,
        .table-dark td,
        .table-dark th,
        .table-dark thead th {
            border-color: #95999c
        }

        .table-hover .table-dark:hover {
            background-color: #b9bbbe
        }

        .table-hover .table-dark:hover>td,
        .table-hover .table-dark:hover>th {
            background-color: #b9bbbe
        }

        .table-active,
        .table-active>td,
        .table-active>th {
            background-color: rgba(0, 0, 0, .075)
        }

        .table-hover .table-active:hover {
            background-color: rgba(0, 0, 0, .075)
        }

        .table-hover .table-active:hover>td,
        .table-hover .table-active:hover>th {
            background-color: rgba(0, 0, 0, .075)
        }

        .table .thead-dark th {
            color: #fff;
            background-color: #343a40;
            border-color: #454d55
        }

        .table .thead-light th {
            color: #495057;
            background-color: #e9ecef;
            border-color: #dee2e6
        }

        .table-dark {
            color: #fff;
            background-color: #343a40
        }

        .table-dark td,
        .table-dark th,
        .table-dark thead th {
            border-color: #454d55
        }

        .table-dark.table-bordered {
            border: 0
        }

        .table-dark.table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, .05)
        }

        .table-dark.table-hover tbody tr:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, .075)
        }

        @media (max-width:575.98px) {
            .table-responsive-sm {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch
            }

            .table-responsive-sm>.table-bordered {
                border: 0
            }
        }

        @media (max-width:767.98px) {
            .table-responsive-md {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch
            }

            .table-responsive-md>.table-bordered {
                border: 0
            }
        }

        @media (max-width:991.98px) {
            .table-responsive-lg {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch
            }

            .table-responsive-lg>.table-bordered {
                border: 0
            }
        }

        @media (max-width:1199.98px) {
            .table-responsive-xl {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch
            }

            .table-responsive-xl>.table-bordered {
                border: 0
            }
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch
        }

        .table-responsive>.table-bordered {
            border: 0
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="user-block">
                            <img class="img-responsive school-logo" alt="School_logo" style="height: 80px; width: 100px"
                                src="../images?>">
                            <div class="text-center">
                                <h3 class="box-title text-bold">Explore Schools</h3>
                                <h6 class="text-bold"><?php echo 'Abubor Nnewichi, Nnewi'; ?></h6>
                                <h6 class="text-bold">Tel. 08103845153. Email: chidideveloper@gmial.com , Web:
                                    schoolweb.com </h6>
                                <h3 class="box-title text-bold">ACADEMIC PERFORMANCE REPORT SHEET</h3>

                            </div>
                            <div class="box-footer">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr class="thead">
                                            <th>NAME: </th>
                                            <td class="pull-left"> Chidiebere Chukwudi </td>
                                            <th>ADMISSION NO.</th>
                                            <td class="pull-left"> mouau/ssc/14/23256</td>
                                        </tr>
                                        <tr class="thead">
                                            <th>Age: </th>
                                            <td class="pull-left"><?php echo ''; ?></td>
                                            <th>House</th>
                                            <td class="pull-left"> <?php echo ''; ?></td>
                                            <th>Class</th>
                                            <td class="pull-left">jss 3</td>
                                        </tr>
                                        <tr class="thead">
                                            <th>No. in Class </th>
                                            <td class="pull-left"> 24 </td>
                                            <th>Term</th>
                                            <td class="pull-left">JSS 1</td>
                                            <th>Session</th>
                                            <td>2021/2022</td>
                                        </tr>
                                    </thead>
                                </table>
                                <table class="table table-condensed table-responsive">
                                    <thead>
                                        <th>Total Marks Obtainable </th>
                                        <td class="pull-left">203</td>
                                        <th>Total Marks Obtained</th>
                                        <td class="pull-left"> 80</td>
                                        <th>Average</th>
                                        <td>
                                            50</td>
                                        <th>Position</th>
                                        <td>
                                            5th
                                            <sup>5<sup>
                                        </td>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class='box-footer text-center'>
                        A(Distinction)70% & above &nbsp;
                        C(Credit)55-69% &nbsp;
                        P(Pass)45-54% &nbsp;
                        F(Fail)Below 45% &nbsp;
                    </div>
                    <div class="box-body no-padding">
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th>Subjects </th>
                                    <th>Total Assess.</th>
                                    <th>Exam Score</th>
                                    <th>Total Score</th>
                                    <th>Class Average</th>
                                    <th>Position</th>
                                    <td>
                                        <b>Grade</b>
                                    </td>
                                    <th>Teacher's Remarks</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>jhj</td>
                                    <td>ggg</td>
                                    <td>ggg</td>
                                    <td>99</td>
                                    <td>ffff</td>
                                    <td>ggg <sup>ggggg </sup></td>
                                    <td>55</td>
                                    <td>555</td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="box-footer">
                            <ul class="list-unstyled">
                                <li><b>Form Teacher's Comment</b> &nbsp;You tried </li>
                                <li><b>Name & Signature</b>
                                    chinwa </li><br>
                                <li><b>Remarks by Principal/Head</b> &nbsp; Satisfactory</li>
                                <li><b>Name & Signature</b> ENGR. PETER CHUKWUNEMEMMA </li><br>
                                <li><b>Resumption Date for 2nd Term:</b> 7th January 2021</li>
                            </ul>
                        </div>
                        <h6 class="pull-right">Date Printed: <?php echo date('Y/m/d'); ?></h6>
                    </div>
                    <div class="box-footer no-print">
                        <button type="button" onclick="window.print();" class="btn btn-sm bg-blue-active pull-right"><i
                                class="fa fa-print"></i> Print</button>
                        <a href="check-result"><button type="button" class="btn btn-sm  bg-blue-active pull-left"><i
                                    class="fa fa-arrow-left"></i> Go Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
