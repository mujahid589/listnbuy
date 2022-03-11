<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use App\Models\Cms;
use App\Models\Customer;
use App\Models\PaymentSetting;
use App\Models\Theme;
use App\Notifications\LogoutNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Transformers\AdResource;
use Modules\Blog\Entities\Post;
use Modules\Category\Entities\Category;
use Modules\Category\Transformers\CategoryResource;
use Modules\Faq\Entities\Faq;
use Modules\Faq\Entities\FaqCategory;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Town;
use Modules\OurTeam\Entities\OurTeam;
use Modules\Plan\Entities\Plan;
use Modules\Tag\Entities\Tag;
use Modules\Testimonial\Entities\Testimonial;
use Response;

class FilterApiController extends Controller
{

}
