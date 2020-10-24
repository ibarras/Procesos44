<?php
namespace ProcesosBundle\IcHelpers;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;


class IcUpload{

	
	/**
	 * @Assert\File(maxSize="6000000", mimeTypes={"image/jpg" , "image/jpeg"} )
	 */
	private $file;
	
	private $imagen;
	
	public $path;
	
	
	public function upload()
	{
	    // the file property can be empty if the field is not required
	    if (null === $this->getFile()) {
	        return;
	    }
	
	    // use the original file name here but you should
	    // sanitize it at least to avoid any security issues
	
	    // move takes the target directory and then the
	    // target filename to move to
	    
	    $this->getFile()->move($this->getWebPath(),$this->imagen);
	     
	    
	    // set the path property to the filename where you've saved the file
	    $this->path = $this->getFile()->getClientOriginalName();
		//$this->temp = 
	    // clean up the file property as you won't need it anymore
	    $this->file = null;
	}
	
    public function getAbsolutePath()
    {
    	return null === $this->path
    	? null
    	: $this->getUploadRootDir().'/'.$this->path;
    }
    
    public function getWebPath()
    {
    	return null === $this->path
    	? null
    	: $this->getUploadDir().'/'.$this->path;
    }
    
    protected function getUploadRootDir()
    {
    	// the absolute directory path where uploaded
    	// documents should be saved
    	return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    
    protected function getUploadDir()
    {
    	// get rid of the __DIR__ so it doesn't screw up
    	// when displaying uploaded doc/image in the view.
    	return 'uploads/imagen';
    }
    
    public function removeUpload()
    {
    	if ($file = $this->getAbsolutePath()) {
    		unlink($file);
    	}
    }

    /**
     * @param File|null $file
     * @param UploadedFile $file
     * @return string
     */
    public function setFile(File $file = null, $ruta = null) 
    {
    	
    	if($file!=null){
    		 
    	$this->file = $file;
    	$this->imagen =  uniqid(mt_rand())  . '.' . $this->getFile()->getClientOriginalExtension();
    	$this->path = $ruta;
    	
    	/*
    	 * Martin Ibarra Cervantes mic@unixmexico.org
    	 * 22/mayo/2014
    	 * Se sube la foto inmediatamente despues de ser recibida.
    	 * Con esto se corrige si se tiene mas de un campo File en una forma.
    	 * 
    	 */
    	$this->upload();
    	return $this->imagen;
    	}

    	return $this->imagen;
    }
    
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
    	return $this->file;
    }
    
	
	
}
