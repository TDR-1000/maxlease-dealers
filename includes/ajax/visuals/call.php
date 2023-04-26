<style>
    .callwrapper {
        position: absolute;
        z-index: 999;
        right: 0;
        width: 450px;
        display: none;
    }

    .active {
        display: block !important;
        
        border-radius: 6px;

    }

    .callerbox{
        padding: 10px;
        animation: color-change 1s infinite;
    }

    @keyframes color-change {
        0% {
            background-color: #153e8f;
        }

        50% {
            background-color: #e85900;
        }

        100% {
            background-color: #153e8f;
        }
    }

        .main_cont {
            background-color: #133f8d;
            border-radius: 0;
            padding: 25px;
            float: left;
            width: 100%;
        }

        .left_side {
            float: left;
        }

        .left_side div {
            display: inline-block;
            color: #fff;
            font: 13px/18px Arial;
        }

        .left_side .image_col {}

        .left_side .image_col img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        .left_side .name_col {
            margin-left: 10px;
        }

        .left_side .name_col h2 {
            font-size: 15px;
        }

        .right_side {
            float: right;
        }

        .right_side button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 0;
            margin-left: 10px;
        }

        .right_side button.video_call,
        .right_side button.audio_call {
            background-color: #007fae;
        }

        .right_side button.audio_call:hover,
        .right_side button.video_call:hover {
            background-color: #0076a2;
        }

        .right_side button.cancel_call {
            background-color: #e81123;
        }

        .footer_cont {
            background-color: #0094cc;
            display: inline-block;
            width: 100%;
            padding: 25px;
            border-radius: 0;
            border: 1px #0094cc solid;
            color: #fff;
            font: 13px/18px Arial;
        }

        .callboxes {
            display: none;
        }

        .hide {
  display: none;
}
    
.myDIV:hover + .hide {
  display: block;
}
</style>

<div class="nk-header-news callerbox callboxes " id="callCHeck">
    <div class="nk-news-list">
        <a class="nk-news-item" id="linkId" href="/offerte">
            <div class="nk-news-icon myDIV">
                <em class="icon ni ni-call-alt"></em>
            </div>
            <div class="nk-news-text hide">
                <p>  <span> <span id="naamCall"> </span> [ <span id="telefoonnummerCall"></span> ]</span></p>
            </div>
        </a>
    </div>
</div>