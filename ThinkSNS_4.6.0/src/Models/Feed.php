<?php

namespace Ts\Models;

use Ts\Bases\Model;

/**
 * 分享数据模型.
 *
 * @author Seven Du <lovevipdsw@outlook.com>
 **/
class Feed extends Model
{
    protected $table = 'feed';

    protected $primaryKey = 'feed_id';

    protected $appends = array('images', 'video');

    /**
     * 关联feedData表.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function data()
    {
        return $this->hasOne('Ts\\Models\\FeedData');
    }

    public function getVideoAttribute()
    {
        if ($this->type != 'postvideo') {
            return null;
        } elseif ($this->data->feed_data_object->video_id) {
            return array(
                'image' => SITE_URL.$this->data->feed_data_object->image_path,
                'src'   => SITE_URL.$this->data->feed_data_object->video_path,
                'type'  => 'ts',
            );
        }

        return array(
            'image' => UPLOAD_URL.$this->data->feed_data_object->flashimg,
            'link'  => $this->data->feed_data_object->source,
            'type'  => 'vendor',
        );
    }

    public function getImagesAttribute()
    {
        if ($this->type != 'postimage') {
            return array();
        } elseif ($this->data->feed_data_object->content) {
            $this->data->feed_content = $this->data->feed_data_object->content;
        }

        $images = array();
        if (isset($this->data->feed_data_object->attach_id[0])) {
            $attachs = Attach::whereIn('attach_id', (array) $this->data->feed_data_object->attach_id)
                ->get();
            $count = $attachs->count();
            foreach ($attachs as $image) {
                switch ($count) {
                    case 1:
                        array_push($images, array(
                            'small'  => $image->imagePath(400, 255),
                            'src'    => $image->path,
                            'width'  => $image->width,
                            'height' => $image->height,
                        ));
                        break;

                    case 2:
                        array_push($images, array(
                            'small'  => $image->imagePath(300, 300),
                            'src'    => $image->path,
                            'width'  => $image->width,
                            'height' => $image->height,
                        ));
                        break;

                    default:
                        array_push($images, array(
                            'small'  => $image->imagePath(200, 200),
                            'src'    => $image->path,
                            'width'  => $image->width,
                            'height' => $image->height,
                        ));
                        break;
                }
            }
        }

        return $images;
    }
} // END class Feed extends Model
