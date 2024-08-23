import { Modal, ModalContent, ModalHeader, ModalBody, ModalFooter, Button} from '@nextui-org/react';

export default function DeleteModal({isOpen, onOpenChange, objectType, onAction}) {
  return <Modal isOpen={isOpen} onOpenChange={onOpenChange}>
    <ModalContent>
      {(onClose) => (
        <>
          <ModalHeader className="flex flex-col gap-1">Delete {objectType}</ModalHeader>
          <ModalBody>
            Are you sure? Deleted item cannot be restored.
          </ModalBody>
          <ModalFooter>
            <Button color="danger" variant="light" onPress={onClose}>
              Cancel
            </Button>
            <Button color="primary" onPress={() => onAction(onClose)}>
              Delete
            </Button>
          </ModalFooter>
        </>
      )}
    </ModalContent>
  </Modal>
}