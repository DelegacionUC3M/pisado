class NameFieldsException(Exception):
    def __init__(self, field=None):
        self.error_field = field


class TypeFieldsException(Exception):
    def __init__(self, field=None):
        self.error_field = field
