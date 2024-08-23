import { Modal, ModalContent, ModalHeader, ModalBody, ModalFooter, Button, Input} from '@nextui-org/react';

export default function NewModal({isOpen, onOpenChange, objectType, onAction, value, onValueChange}) {
  return <Modal isOpen={isOpen} onOpenChange={onOpenChange}>
    <ModalContent>
      {(onClose) => (
        <>
          <ModalHeader className="flex flex-col gap-1">New {objectType}</ModalHeader>
          <ModalBody>
            <Input type="text" label={`${objectType} name`} value={value} onChange={(e) => onValueChange(e.target.value)} />
          </ModalBody>
          <ModalFooter>
            <Button color="danger" variant="light" onPress={onClose}>
              Cancel
            </Button>
            <Button color="primary" onPress={() => onAction(onClose)}>
              Create
            </Button>
          </ModalFooter>
        </>
      )}
    </ModalContent>
  </Modal>
}