@extends('frontend.postad.index')

@section('title', __('website.step3'))

@section('post-ad-content')
 <!-- Steop 03 -->
 <div class="tab-pane fade show active" id="pills-advance" role="tabpanel" aria-labelledby="pills-advance-tab">
    <div class="dashboard-post__step02 step-information">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container-fluid">
            <div class="row">

                @forelse ($plans as $plan)
                    <div class="d-none">

                    </div>

                    <div class="col-xl-3 col-lg-3">
                        <div class="plan-card {{ $plan->recommended ? 'plan-card--active':'' }}">
                            <div class="plan-card__top">
                                <h2 class="plan-card__title text--body-1"> {{ $plan->label }} </h2>
                                <p class="plan-card__description">
                                    {{ $plan->description }}
                                </p>
                                <div class="plan-card__price">
                                    <h5 class="text--display-3">${{ $plan->price }}</h5>
                                </div>

                                    {{--                                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" id="stripe-button"--}}
                                    {{--                                        data-key="{{ array_key_exists('STRIPE_KEY', $_SERVER) ? $_SERVER['STRIPE_KEY'] : env('STRIPE_KEY')}}" data-amount="{{ $plan->price*100 }}" data-name="{{ array_key_exists('APP_NAME', $_SERVER) ? $_SERVER['APP_NAME'] : env('APP_NAME')}}"--}}
                                    {{--                                        data-description="ListnBuy Subscription"  data-locale="auto" data-currency="usd">--}}
                                    {{--                                </script>--}}

                                    <a  onclick="selectSubscriptionPlan( {{ $plan->id }}, {{ $plan->price }})"
                                        id="subscription-button-{{ $plan->id}}"
                                        class="btn btn-block btn-outline-primary plan-card__select-pack btn btn--bg w-100"
                                    >
                                        {{ __('website.choose_plan') }}
                                        <span class="icon--right">
                                            <x-svg.right-arrow-icon />
                                        </span>
                                    </a>

                            </div>
                            <div class="plan-card__bottom">
                                <div class="plan-card__package">
                                    <div class="plan-card__package-list active">
                                        <span class="icon">
                                            <x-svg.check-icon />
                                        </span>
                                        <h5 class="text--body-3">{{ __('website.post') }} {{ $plan->ad_limit }} {{ __('website.ads') }}</h5>
                                    </div>
                                    <div class="plan-card__package-list  {{ $plan->multiple_image ? 'active':'' }} ">
                                        <span class="icon">
                                            <x-svg.check-icon />
                                        </span>
                                        <h5 class="text--body-3"> {{ __('website.multiple_images') }} </h5>
                                    </div>
                                    <div class="plan-card__package-list {{ $plan->featured_limit ? 'active':'' }}">
                                        <span class="icon">
                                            <x-svg.check-icon />
                                        </span>
                                        <h5 class="text--body-3">{{ $plan->featured_limit }} {{ __('website.featured_ads') }}</h5>
                                    </div>
                                    <div class="plan-card__package-list {{ $plan->customer_support ? 'active':'' }} ">
                                        <span class="icon">
                                            <x-svg.check-icon />
                                        </span>
                                        <h5 class="text--body-3">{{ __('website.basic_customer_support') }}</h5>
                                    </div>
                                    <div class="plan-card__package-list {{ $plan->badge? 'active':'' }} ">
                                        <span class="icon">
                                            <x-svg.check-icon />
                                        </span>
                                        <h5 class="text--body-3">{{ __('website.special_membership_badge') }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <x-no-data-found/>
                @endforelse

            </div>

        </div>




        <form class="form-stripe" action="{{ route('frontend.post.step3.store') }}" method="POST" enctype="multipart/form-data" >
            @csrf


            <input type="hidden" name="amount" value="0">
            <input type="hidden" id="plan_id" name="plan_id" value="0">

            <script id="stripe_script" src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="pk_test_51JZxd1FyqW4x6na2szRpArr1kGMvWd4l9GvH9FZPSxBRxYk7O6LMjoGhcn55SCZernU1QKDWyWvrFM22eWVc3XAr00p3KQ6d11" data-amount="0" data-name="{{ env('APP_NAME') }}"
                    data-description="Money pay with stripe" data-locale="auto" data-currency="usd">
            </script>


            <div class="dashboard-post__ads-bottom">
                <div class="form-check">
                </div>
                <div class="dashboard-post__action-btns">
                    <a onclick="return confirm('Do you really want to go previous page? If you go then your step 3 data wont save!')" href="{{ route('frontend.post.step2.back') }}" class="btn btn--lg btn--outline">
                        Previous
                    </a>
                    <button type="submit" class="btn btn--lg">
                        Post Ads
                        <span class="icon--right">
                            <x-svg.right-arrow-icon />
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>

     <div class="modal" tabindex="-1" id="sucessmodal">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Success message</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body" style="display: flex;align-items: center;justify-content: center">
                     <p>Thank you you have upgraded you plan and submitted your post</p>
                 </div>

             </div>
         </div>
     </div>
</div>
@endsection

@section('frontend_script')
<script>

    var token = function(res){

        console.log(res);

        var sucessModal = new bootstrap.Modal(document.getElementById("sucessmodal"), {})
        sucessModal.show()
        var $input = $('<input type=hidden name=stripeToken />').val(res.id);

        // show processing message, disable links and buttons until form is submitted and reloads
        $('a').bind("click", function() { return false; });
        $('button').addClass('disabled');
        $('.overlay-container').show();

        // submit form
        // $('.form-stripe').append($input).submit();
        $('.form-stripe').submit();
    };

    function selectSubscriptionPlan(plan_id, display_price) {
        selectedSubscriptionPlan = display_price;
        $('[name="plan_id"]').val(plan_id);
        $("[id^=subscription-button-]").removeClass('btn-primary')
        $("[id^=subscription-button-]").addClass('btn-outline-primary')
        $('#subscription-button-' + plan_id).removeClass('btn-outline-primary')
        $('#subscription-button-' + plan_id).addClass('btn-primary')
        //e.preventDefault();
        //$('.stripe-button-el').click();
         // StripeCheckout.__app.configurations.button0.amount = parseFloat(display_price) * 100;
        $('#stripe-button').attr("data-amount", parseFloat(display_price) * 100); //setter

        StripeCheckout.open({
            key:         'pk_test_51JZxd1FyqW4x6na2szRpArr1kGMvWd4l9GvH9FZPSxBRxYk7O6LMjoGhcn55SCZernU1QKDWyWvrFM22eWVc3XAr00p3KQ6d11',
            amount:      (parseFloat(display_price) * 100),
            name:        "pay to list and buy",
            image:       'https://res.cloudinary.com/kavitdigital/image/upload/v1/listnbuy/public/website/1645142925_620ee38dace32.jpg',
            description: "",
            panelLabel:  'Checkout',
            token:       token
        });
       // $('.stripe-button-el').click();
       // submitStepForm()
    }



    function add_features_field() {
        $("#multiple_feature_part").append(`
            <div class="row">
                <div class="col-lg-10">
                        <div class="input-field">
                            <input name="features[]" type="text" placeholder="Feature" id="adname" class="@error('title') border-danger @enderror"/>
                        </div>
                </div>
                <div class="col-lg-2 mt-10">
                    <button onclick="remove_single_field()" id="remove_item" class="btn btn-sm bg-danger text-light"><i class="fas fa-times"></i></button>
                </div>
            </div>
        `);
    }

    $(document).on("click", "#remove_item", function() {
        $(this).parent().parent('div').remove();
    });
</script>

<script>
// File Upload
const uploadArea = document.querySelector('.upload-area');
const uploadedItems = document.querySelector('.uploaded-items');
const input = document.querySelector('#addNew');
const inputButton = document.querySelector('.add-new');

// add new file
if (inputButton) {
    inputButton.addEventListener('click', (event) => {
        handleDragArea(true);
        input.click();
    });
}

// display file on file upload
if (input) {
    input.addEventListener('change', (event) => {
        let files = event.target.files;

        for (let i = 0; i < files.length; i++) {
            displayFile(files[i]);
            handleDragArea(false);
        }
    });
}

// dragover event
if (uploadArea) {
    uploadArea.addEventListener('dragover', (event) => {
        handleDragArea(true);
        event.preventDefault();
    });
}

// dragleave event
if (uploadArea) {
    uploadArea.addEventListener('dragleave', (event) => {
        handleDragArea(false);
    });
}

// drop event
if (uploadArea) {
    uploadArea.addEventListener('drop', (event) => {
        event.preventDefault();
        let file = event.dataTransfer.files[0];
        displayFile(file);
    });
}

// Handle drag over and drag leave effect
function handleDragArea(param) {
    if (param == true) {
        uploadArea.classList.add('active');
    } else {
        uploadArea.classList.remove('active');
    }
}

// display uploadedFile
function displayFile(file) {
    let fileType = file.type;
    let validExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
    let fileURL;

    if (validExtensions.includes(fileType)) {
        let fileReader = new FileReader();

        fileReader.onload = () => {
            fileURL = fileReader.result;
            addNewfile(fileURL);
        };
        fileReader.readAsDataURL(file);
    } else {
        alert('File type not supported');
        handleDragArea(false);
    }
}

// Append New File in HTML
function addNewfile(file) {
    let imgTag = `
    <div class="uploaded-item">
        <img src="${file}" alt="">
        <div class="remove-icon">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        </div>
    </div>`;
    uploadedItems.insertAdjacentHTML('beforeend', imgTag);
}

$(document).on('click', '.remove-icon', function () {
    $(this).closest('.uploaded-item').remove()
});
</script>
@endsection
