<?php

namespace spec\Cavis\Core\Usecase\Image\Add;

use PHPSpec2\ObjectBehavior;

class Submission extends ObjectBehavior
{
    /**
     * @param Cavis\Core\Data\Image $image
     * @param Cavis\Core\Data\File $file
     * @param Cavis\Core\Data\Category $category
     * @param Cavis\Core\Usecase\Image\Add\Repository $repository
     * @param Cavis\Core\Tool\Photoshopper $photoshopper
     * @param Cavis\Core\Tool\Validator $validator
     */
    function let($image, $file, $category, $repository, $photoshopper, $validator)
    {
        $category->id = 'category_id';
        $file->name = 'file_name';
        $file->tmp_name = 'file_tmp_name';
        $file->mimetype = 'image/png';
        $file->filesize_in_bytes = 42;
        $file->error_code = 0;
        $image->name = 'name';
        $image->author = 'author';
        $image->website = 'website';
        $image->email = 'email';
        $image->summary = 'summary';
        $image->description = 'description';
        $image->file = $file;
        $image->supplementary_files = array($file, $file);
        $image->category = $category;
        $this->beConstructedWith($image, $repository, $photoshopper, $validator);
        $this->name->shouldBe('name');
        $this->file->shouldBe($file);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Cavis\Core\Usecase\Image\Add\Submission');
    }

    function it_should_be_an_image()
    {
        $this->shouldHaveType('Cavis\Core\Data\Image');
    }

    function it_should_validate_the_submission($validator)
    {
        $validator->setup(array(
            'name' => 'name',
            'author' => 'author',
            'website' => 'website',
            'email' => 'email',
            'summary' => 'summary',
            'description' => 'description',
            'file' => array(
                'name' => 'file_name',
                'tmp_name' => 'file_tmp_name',
                'type' => 'image/png',
                'size' => 42,
                'error' => 0
            ),
            'category_id' => 'category_id'
        ))->shouldBeCalled();
        $validator->rule('name', 'not_empty')->shouldBeCalled();
        $validator->rule('name', 'max_length', 60)->shouldBeCalled();
        $validator->rule('author', 'not_empty')->shouldBeCalled();
        $validator->rule('author', 'max_length', 60)->shouldBeCalled();
        $validator->rule('website', 'url')->shouldBeCalled();
        $validator->rule('email', 'email')->shouldBeCalled();
        $validator->rule('summary', 'not_empty')->shouldBeCalled();
        $validator->rule('description', 'not_empty')->shouldBeCalled();
        $validator->rule('file', 'upload_not_empty')->shouldBeCalled();
        $validator->rule('file', 'upload_valid')->shouldBeCalled();
        $validator->rule('file', 'upload_type', array('jpg', 'png', 'jpeg'))->shouldBeCalled();
        $validator->rule('file', 'upload_size', '3M')->shouldBeCalled();
        $validator->callback('category_id', array($this, 'is_an_existing_category_id'), array('category_id'))->shouldBeCalled();
        $validator->check()->shouldBeCalled()->willReturn(TRUE);
        $this->validate();
    }

    function it_validates_the_supplementary_files_in_turn($validator)
    {
        $validator->setup(array(
            'supplementary_file' => array(
                'name' => 'file_name',
                'tmp_name' => 'file_tmp_name',
                'type' => 'image/png',
                'size' => 42,
                'error' => 0
            )
        ))->shouldBeCalled();
        $validator->rule('supplementary_file', 'upload_valid')->shouldBeCalled();
        $validator->rule('supplementary_file', 'upload_type', array('jpg', 'png', 'jpeg'))->shouldBeCalled();
        $validator->rule('supplementary_file', 'upload_size', '3M')->shouldBeCalled();
        $validator->check()->shouldBeCalled()->willReturn(TRUE);
        $this->validate_supplementary_files();
    }

    function it_can_check_for_existing_categories($repository)
    {
        $repository->does_category_exist('id')->shouldBeCalled()->willReturn(TRUE);
        $this->is_an_existing_category_id('id')->shouldReturn(TRUE);
    }

    function it_should_throw_an_error_at_invalid_submissions($validator)
    {
        $validator->check()->shouldBeCalled()->willReturn(FALSE);
        $validator->errors()->shouldBeCalled()->willReturn(array('name', 'file'));
        $this->shouldThrow('Cavis\Core\Exception\Validation')
            ->duringValidate();
    }

    function it_checks_whether_or_not_the_image_is_wider_than_the_layout($photoshopper)
    {
        $photoshopper->setup('file_tmp_name')->shouldBeCalled();
        $photoshopper->get_width()->shouldBeCalled()->willReturn(1200);
        $this->is_wider_than_layout()->shouldReturn(FALSE);
    }

    function it_checks_if_the_image_is_thinner_than_the_layout($photoshopper)
    {
        $photoshopper->setup('file_tmp_name')->shouldBeCalled();
        $photoshopper->get_width()->shouldBeCalled()->willReturn(1201);
        $this->is_wider_than_layout()->shouldReturn(TRUE);
    }

    function it_can_resize_image_to_layout_width($photoshopper)
    {
        $photoshopper->setup('file_tmp_name')->shouldBeCalled();
        $photoshopper->resize_to_width(1200)->shouldBeCalled();
        $this->resize_to_layout();
    }

    function it_can_resize_supplementary_files($photoshopper)
    {
        $photoshopper->setup('file_tmp_name')->shouldBeCalled();
        $photoshopper->resize_to_width(600)->shouldBeCalled();
        $this->resize_supplementary_files();
    }

    function it_generates_a_thumbnail($photoshopper)
    {
        $photoshopper->setup('file_tmp_name', 'file_tmp_name.thumb.png')->shouldBeCalled();
        $photoshopper->resize_to_width(222)->shouldBeCalled();
        $this->thumbnail->shouldBe(NULL);
        $this->generate_thumbnail();
        $this->thumbnail->full_path->shouldBe('file_tmp_name.thumb.png');
    }

    function it_submits_the_proposal($repository)
    {
        $this->generate_thumbnail();
        $repository->save_file($this->thumbnail)->shouldBeCalled()->willReturn('thumbnail_path');
        $repository->save_file($this->file)->shouldBeCalled()->willReturn('file_path');
        $repository->save_image(
            'name',
            'thumbnail_path',
            'file_path',
            array('file_path', 'file_path'),
            'category_id'
        )->shouldBeCalled()->willReturn('image_id');
        $this->submit()->shouldReturn('image_id');
    }
}
