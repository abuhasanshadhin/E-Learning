<!DOCTYPE html>
<html lang="en">
<body>
    
    <p>Dear Subscriber,</p>

    <p>New lesson added. Please click the following link : </p>
    
    <a href="{{ route('website.lesson', [$new_lesson->id, str_slug($new_lesson->title)]) }}">
        {{ route('website.lesson', [$new_lesson->id, str_slug($new_lesson->title)]) }}
    </a>

    <p>Thanks!</p>

</body>
</html>