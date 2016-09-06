<?php

namespace ride\library\http\jsonapi;

class JsonApiResourceTest extends AbstractLinkedJsonApiElementTest {

    protected function createTestInstance() {
        return new JsonApiResource('type', 'id');
    }

    public function testConstruct() {
        $type = 'type';
        $id = 'id';

        $resource = new JsonApiResource($type);

        $this->assertEquals($type, $resource->getType());
        $this->assertNull($resource->getId());

        $resource = new JsonApiResource($type, $id);

        $this->assertEquals($type, $resource->getType());
        $this->assertEquals($id, $resource->getId());
    }

    public function testRelationshipPath() {
        $relationshipPath = 'path';

        $resource = $this->createTestInstance();

        $this->assertNull($resource->getRelationshipPath());

        $resource->setRelationshipPath($relationshipPath);

        $this->assertEquals($relationshipPath, $resource->getRelationshipPath());
    }

    public function testAttributes() {
        $attribute1 = 'attribute1';
        $attribute2 = 'attribute2';
        $value1 = 'value1';
        $value2 = 'value2';
        $default = 'default';

        $resource = $this->createTestInstance();

        $this->assertEquals(array(), $resource->getAttributes());

        $resource->setAttribute($attribute1, $value1);
        $resource->setAttribute($attribute2, $value2);

        $expected = array(
            $attribute1 => $value1,
            $attribute2 => $value2,
        );

        $this->assertEquals($expected, $resource->getAttributes());
        $this->assertEquals($value1, $resource->getAttribute($attribute1));
        $this->assertEquals($value1, $resource->getAttribute($attribute1, $default));
        $this->assertEquals($value2, $resource->getAttribute($attribute2));
        $this->assertEquals($default, $resource->getAttribute('attribute3', $default));
        $this->assertNull($resource->getAttribute('attribute3'));
    }

    public function testRelationships() {
        $relationshipName1 = 'relationship1';
        $relationshipName2 = 'relationship2';
        $relationship1 = new JsonApiRelationship();
        $relationship1->setMeta('value', $relationshipName1);
        $relationship2 = new JsonApiRelationship();
        $relationship2->setMeta('value', $relationshipName2);

        $resource = $this->createTestInstance();

        $this->assertEquals(array(), $resource->getRelationships());

        $resource->setRelationship($relationshipName1, $relationship1);
        $resource->setRelationship($relationshipName2, $relationship2);

        $expected = array(
            $relationshipName1 => $relationship1,
            $relationshipName2 => $relationship2,
        );

        $this->assertEquals($expected, $resource->getRelationships());
        $this->assertEquals($relationship1, $resource->getRelationship($relationshipName1));
        $this->assertEquals($relationship2, $resource->getRelationship($relationshipName2));
        $this->assertNull($resource->getRelationship('relationship3'));
    }

    public function testGetJsonValue() {

    }

}
