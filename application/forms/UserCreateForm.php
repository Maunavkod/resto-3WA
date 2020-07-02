<?php

class UserCreateForm extends Form
{
    public function build()
    {
        $this->addFormField('first_name');
        $this->addFormField('last_name');
        $this->addFormField('email');
        $this->addFormField('address');
        $this->addFormField('zip_code');
        $this->addFormField('city');
        $this->addFormField('phone');
        // Attention on omet le champ password car on ne le retourne ou réaffiche jamais !
    }
}