<?php
/**
 * Created by PhpStorm.
 * User: matthewmanuel
 * Date: 27/05/15
 * Time: 10:56 PM
 */

$bst = new BinarySearchTree();
$bst->Initiate();

class Node
{
    public $data = NULL;
    public $left = NULL;
    public $right = NULL;

    public function __construct($data = NULL)
    {
        $this->data = $data;
    }
}

class BinarySearchTree {

    private $_rootNode = NULL;

    public function &CreateLeaf($data)
    {
        $node = new Node($data);
        return $node;
    }

    public function Initiate()
    {
        $array = [5,10,3,25,71,11,22,151,67,88,99,44,47,32];

        foreach($array as &$arr)
        {
            echo "index ";
            echo $arr;
            echo "\n";
            $this->AddLeaf($arr);
        }

        $this->PrintInOrder();

    }

    public function AddLeaf($data) //Adds the initial root
    {
        $this->AddLeafPrivate($data, $this->_rootNode);
    }

    function AddLeafPrivate($data, &$node)
    {
        if($this->_rootNode === NULL)
        {
            $this->_rootNode = $this->CreateLeaf($data);
        }
        else if($data < $node->data )
        {
            if($node->left !== NULL) //Keep traversing the LeftChild recursively.
            {
                $this->AddLeafPrivate($data, $node->left);
            }
            else
            {
                $node->left = $this->CreateLeaf($data);
            }
        }
        else if($data > $node->data )
        {
            if($node->right !== NULL)//Keep traversing the Rightchild recursively.
            {
                $this->AddLeafPrivate($data, $node->right);
            }
            else
            {
                $node->right = $this->CreateLeaf($data);
            }
        }
        else
        {
            echo "Value already exists! \n";
        }
    }

    function PrintInOrderPrivate(Node &$node)
    {
        if($this->_rootNode != NULL )
        {
            if($node->left != NULL)
            {
               $this->PrintInOrderPrivate($node->left);
            }

            echo $node->data;
            echo "\n";

            if($node->right != NULL)
            {
                $this->PrintInOrderPrivate($node->right);
            }
        }

    }

    public function PrintInOrder()
    {
        $this->PrintInOrderPrivate($this->_rootNode);
    }

    //TODO PrintPreOrder
    //TODO PrintPostOrder




}


