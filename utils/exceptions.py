class NameFieldsException(Exception):
    def __init__(self, field=None):
        self.error_field = field


class TypeFieldsException(Exception):
    def __init__(self, error_field=None, error_type=None):
        self.error_field = error_field
        self.error_type = error_type
